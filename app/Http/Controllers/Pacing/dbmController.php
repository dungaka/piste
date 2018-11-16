<?php

namespace App\Http\Controllers\Pacing;

use App\Client;
use App\Result;
use App\Campaign;
use App\InsertionOrder;
use App\Flight;

Use Carbon\Carbon;
use League\Csv\Reader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dbmController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $advertiser_ids = [];
        foreach($clients as $client) {
            $advertiser_ids[] = $client->dbm_advertiser_id;
        }
        Campaign::truncate();
        InsertionOrder::truncate();
        Flight::truncate();
        

        $client = new \Google_Client();

        $client->setAuthConfig(getenv('GOOGLE_APPLICATION_CREDENTIALS'));
        $client->setScopes([
            'https://www.googleapis.com/auth/doubleclickbidmanager'
        ]);
        $client->setAccessType('offline');
        $client->setApplicationName("Expression_Reporting");
        
        $service = new \Google_Service_DoubleClickBidManager($client);

        $sdf_request = new \Google_Service_DoubleClickBidManager_DownloadRequest();
        $sdf_request->setFilterType("ADVERTISER_ID");
        $sdf_request->setFilterIds($advertiser_ids);
        $sdf_request->setFileTypes([
            "CAMPAIGN", 
            "INSERTION_ORDER", 
            "LINE_ITEM", 
            "AD", 
            "AD_GROUP"
        ]);

        $result = $service->sdf->download($sdf_request);

        // Read CSV and save as the file
        $file = Reader::createFromString($result->insertionOrders);
        // Set the first row as the header offset
        $file->setHeaderOffset(0);
        // Get each line of the CSV as a record
        $records = $file->getRecords();
        // Build each record as an associative array with the header offset as keys
        foreach ($records as $offset => $record) {
            // Insert the record into the table
            $insertion_order = InsertionOrder::create([
                'dbm_insertion_order_id' => $record["Io Id"],
                'dbm_campaign_id' => $record["Campaign Id"],
                'io_name' => $record["Name"],
                'status' => $record["Status"],
                'pacing' => $record["Pacing"],
                'pacing_rate' => $record["Pacing Rate"]
            ]);
            $budgets = str_replace("(", "", $record["Budget Segments"]);
            $budgets = str_replace(";", "", $budgets);
            $budgets = explode(") ", $budgets);
            $budgets = str_replace(")", "", $budgets);
            $flights = [];
            foreach ($budgets as $budget) {
                $budget = explode(' ', $budget);
                $flights[] = $budget;
            }
                            
            foreach ($flights as $flight) {
                $start = Carbon::parse($flight[1]);
                $end = Carbon::parse($flight[2]);

                $duration = $start->diffInDays($end) + 1;

                Flight::create([
                    'insertion_order_id' => $insertion_order->id,
                    'amount_budgeted' => $flight[0],
                    'start' => $start,
                    'end' => $end,
                    'duration' => $duration
                ]);
            }
        }
        // Read CSV and save as the file
        $file = Reader::createFromString($result->campaigns);
        // Set the first row as the header offset
        $file->setHeaderOffset(0);
        // Get each line of the CSV as a record
        $records = $file->getRecords();
        // Build each record as an associative array with the header offset as keys
        foreach ($records as $offset => $record) {
            // Insert the record into the table
            Campaign::create([
                'dbm_campaign_id' => $record["Campaign Id"],
                'dbm_advertiser_id' => $record["Advertiser Id"],
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function results()
    {
        Result::truncate();
        $client = new \Google_Client();

        $client->setAuthConfig(getenv('GOOGLE_APPLICATION_CREDENTIALS'));
        $client->setScopes([
            'https://www.googleapis.com/auth/doubleclickbidmanager'
        ]);
        $client->setAccessType('offline');
        $client->setApplicationName("Expression_Reporting");
        
        $service = new \Google_Service_DoubleClickBidManager($client);

        $report = $service->reports->listreports(161889303);

        $report = end($report->reports)->metadata->googleCloudStoragePath;

        $httpClient = $service->getClient()->authorize();
        $request = new \GuzzleHttp\Psr7\Request('GET', $report);
        $result = $httpClient->send($request);

        // // Read CSV and save as the file
        $file = Reader::createFromString($result->getBody());
        // Set the first row as the header offset
        $file->setHeaderOffset(0);
        // Get each line of the CSV as a record
        $records = $file->getRecords();
        // Build each record as an associative array with the header offset as keys
        $results = [];
        foreach ($records as $offset => $record) {
            // Insert the record into the table
            if($record["Advertiser"] == "") {
                break;
            } else {
                $results[] = [
                    'dbm_insertion_order_id' => $record["Insertion Order ID"],
                    'date' => Carbon::parse($record["Date"]),
                    'amount_spent' => $record["Revenue (Adv Currency)"],
                    'impressions' => $record["Impressions"],
                    'clicks' => $record["Clicks"]
                ];
            }
        }
        foreach(array_chunk($results, 500) as $result) {
            Result::insert($result);
        }
    }
}
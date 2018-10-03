<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Google;

class AdServerController extends Controller
{
    // Make a call to something from Google
    public function index()
    {
        $service = new Google();
        $service = $service->googleClient();

        // List all reports run by this account
        $reports = collect($service->reports->listReports(Google::$user_id));

        return view('reports.ad_server.index', [
            'reports' => $reports,
        ]);
    }

    // Create a standard report
    public function create($report_type)
    {
        $report = new Google();
        $fields = $report->availableFields($report_type);

        return view('reports.ad_server.create', [
            'fields' => $fields
        ]);
    }

    // Edit an existing report
    public function edit($report_id)
    {
        return view('.reports.ad_server.edit', [
            'report_id' => $report_id
        ]);
    }

    // Store the report on Ad Server and run to create a file
    // If coming from edit, creates new file in existing report
    public function store()
    {
        $this->validate(request(), [
            'report_name' => 'required',
            'file_name' => 'required',
            'start' => 'required', 
            'end' => 'required', 
            'client_id' => 'required', 
        ]);

        // Check whether we are storing a new report or adding a file to an exising one.
        $report = new Google();
        if (isset($report_id)) {
            // Patches an existing report
            $report->createReport(request(), $report_id);
        } else {
            // Makes a new report
            $report->createReport(request());
        }

        return redirect('/reports/ad-server/' . $report['id']);
    }

    // Show a report and all of the files inside
    public function show($report_id)
    {
        $service = new Google();
        $service = $service->googleClient();

        $report = $service
        ->reports_files
        ->listReportsFiles(Google::$user_id, $report_id);

        $files = $service
            ->reports_files
            ->listReportsFiles(Google::$user_id, $report_id);

        $files = collect($files);

        return view('reports.ad_server.show', [
            'files' => $files,
            'report' => $report,
            'report_id' => $report_id,
        ]);
    }

    // Destroy a report and all the files within
    public function destroy($report_id)
    {
        $service = new Google();
        $service = $service->googleClient();

        $response = $service
            ->reports
            ->delete(Google::$user_id, $report_id);

        return redirect('/reports/ad-server');
    }

    // Download a CSV of a file in the report.
    public function download($report_id, $file_id)
    {
        $service = new Google();
        $service = $service->googleClient();

        $httpClient = $service->getClient()->authorize();
        $request = new \GuzzleHttp\Psr7\Request('GET', 
            'https://www.googleapis.com/dfareporting/v3.0/reports/' . 
            '116506746' . 
            '/files/' . 
            '668212664' . 
            '?alt=media'
        );
        $result = $httpClient->send($request);

        // TODO make this write a CSV then readfile on the CSV.
        print $result->getBody();
    }

    // TODO make a method to download all files of a report in an excel file.
}

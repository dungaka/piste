<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Programmatic;

class ProgrammaticController extends Controller
{
    public function index()
    {
        // dd('test');

        $client = new \Google_Client();

        $client->setAuthConfig(getenv('GOOGLE_APPLICATION_CREDENTIALS'));

        $client->setScopes([
            'https://www.googleapis.com/auth/dfareporting',
            'https://www.googleapis.com/auth/doubleclickbidmanager',
        ]);

        $client->setApplicationName("Expression_Reporting");
        $service = new \Google_Service_DoubleClickBidManager($client);

        $report = new \Google_Service_DoubleClickBidManager_Report();
        
        dd($report);
    }
}
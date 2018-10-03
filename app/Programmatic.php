<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Programmatic extends Model
{
    public static $user_id = '4304637';

    function googleClient()
    {
        $client = new \Google_Client();

        $client->setAuthConfig(getenv('GOOGLE_APPLICATION_CREDENTIALS'));

        $client->setScopes([
            'https://www.googleapis.com/auth/doubleclickbidmanager',
        ]);

        $client->setApplicationName("Expression_Reporting");
        $service = new \Google_Service_DoubleClickBidManager($client);

        return $service;
    }

    // function createReport(Request $request, $report_id = null)
    // {
    //     $service = $this->googleClient();
        
    //     $report = new \Google_Service_Dfareporting_Report();
    //     $report->setName(request('report_name'));
    //     $report->setFileName(request('file_name'));
    //     $report->setType('STANDARD');

    //     $dateRange = new \Google_Service_Dfareporting_DateRange();
    //     $dateRange->setStartDate(request('start'));
    //     $dateRange->setEndDate(request('end'));

    //     $dimension = new \Google_Service_Dfareporting_SortedDimension();
    //     $dimension->setName('dfa:advertiser');

    //     $filter = new \Google_Service_Dfareporting_DimensionValue();
    //     $filter->setDimensionName('dfa:advertiser');
    //     $filter->setId(request('client_id'));
    //     $filter->setMatchType('EXACT');

    //     $criteria = new \Google_Service_Dfareporting_ReportCriteria();
    //     $criteria->setDateRange($dateRange);
    //     $criteria->setDimensions([$dimension]);
    //     $criteria->setMetricNames(['dfa:clicks', 'dfa:impressions']);
    //     $criteria->setDimensionFilters($filter);

    //     $report->setCriteria($criteria);

    //     if (isset($report_id)) {
    //         // Patches an existing report
    //         $report = $service->reports->patch(Google::$user_id, $report_id, $report);  
    //     } else {
    //         // Makes a new report
    //         $report = $service->reports->insert(Google::$user_id, $report);
    //     }

    //     // Run the Report and generate file
    //     $service->reports->run(
    //         Google::$user_id,
    //         $report['id'],
    //         ['synchronous' => true]
    //     );

    //     return $report;
    // }

    // function availableFields($report_type)
    // {
    //     $report_type = strtoupper($report_type);
    //     $service = $this->googleClient();

    //     $report = new \Google_Service_Dfareporting_Report();
    //     // Make the type a variable at some point
    //     $report->setType($report_type);
    //     $report->setName('dummy');
    //     $report = $service->reports->insert(Google::$user_id, $report);

    //     // Look up the compatible fields for this report
    //     $fields = $service->reports_compatibleFields->query(
    //         Google::$user_id,
    //         $report
    //     );

    //     // Cleanup dummy report
    //     $service->reports->delete(Google::$user_id, $report->id);

    //     $fields = array(
    //         'dimensions' => collect($fields['reportCompatibleFields']['dimensions']),
    //         'metrics' =>  collect($fields['reportCompatibleFields']['metrics']),
    //         'dimensionFilters' =>  collect($fields['reportCompatibleFields']['dimensionFilters']),
    //         'pivotedActivityMetrics' => collect($fields['reportCompatibleFields']['pivotedActivityMetrics'])
    //     );

    //     return $fields;
    // }
}
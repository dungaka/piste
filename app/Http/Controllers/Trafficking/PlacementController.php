<?php

namespace App\Http\Controllers\Trafficking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Google;

class PlacementController extends Controller
{
    function createPlacement(Request $request)
    {
        $service = new Google();
        $service = $service->googleClient();
        
        $campaign = $service->campaigns->get(
            Google::$user_id, '21781241');
        $placement = new \Google_Service_Dfareporting_Placement();
        $placement->setCampaignId('21781241');
        $placement->setCompatibility('DISPLAY');
        $placement->setName('TEST_DISPLAY_PLACEMENT');
        $placement->setPaymentSource('PLACEMENT_AGENCY_PAID');
        $placement->setSiteId('3468006');
        $placement->setTagFormats(['PLACEMENT_TAG_STANDARD']);
        // Set the size of the placement.
        $size = new \Google_Service_Dfareporting_Size();
        $size->setId('21');
        $placement->setSize($size);
        // Set the pricing schedule for the placement.
        $pricingSchedule = new \Google_Service_Dfareporting_PricingSchedule();
        $pricingSchedule->setEndDate($campaign->getEndDate());
        $pricingSchedule->setPricingType('PRICING_TYPE_CPM');
        $pricingSchedule->setStartDate($campaign->getStartDate());
        $placement->setPricingSchedule($pricingSchedule);
        // Insert the placement.
        $result = $service->placements->insert(
            Google::$user_id, $placement
        );
    }
}

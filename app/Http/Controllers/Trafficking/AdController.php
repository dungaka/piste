<?php

namespace App\Http\Controllers\Trafficking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Google;

class AdController extends Controller
{
    function createAd(Request $request)
    {
        $service = new Google();
        $service = $service->googleClient();
        
        $campaign = $service->campaigns->get(
            Google::$user_id, '21781241');

        // Create a placement assignment.
        $placementAssignment = new \Google_Service_Dfareporting_PlacementAssignment();
        $placementAssignment->setActive(true);
        $placementAssignment->setPlacementId('230882286');

        // Create a delivery schedule.
        $deliverySchedule = new \Google_Service_Dfareporting_DeliverySchedule();
        $deliverySchedule->setImpressionRatio(1);
        $deliverySchedule->SetPriority('AD_PRIORITY_01');

        $startDate = new \DateTime('today');
        $endDate = new \DateTime('tomorrow');

        // Create a rotation group.
        $ad = new \Google_Service_Dfareporting_Ad();
        $ad->setActive(false);
        $ad->setCampaignId('21781241');
        $ad->setDeliverySchedule($deliverySchedule);
        $ad->setStartTime($startDate->format('Y-m-d') . 'T23:59:59Z');
        $ad->setEndTime($endDate->format('Y-m-d') . 'T00:00:00Z');
        $ad->setName('TEST_AD');
        $ad->setPlacementAssignments([$placementAssignment]);
        $ad->setType('AD_SERVING_STANDARD_AD');
        $result = $service->ads->insert(Google::$user_id, $ad);
    }

    function createCreative(Request $request)
    {
        $image = asset('images/anchor.jpg');
        $service = new Google();
        $service = $service->googleClient();
        
        $campaign = $service->campaigns->get(
            Google::$user_id, '21781241');

        $creative = new \Google_Service_Dfareporting_Creative();
        $creative->setAdvertiserId('6900281');
        $creative->setName('Test image display creative');
        $creative->setType('DISPLAY');
        $size = new \Google_Service_Dfareporting_Size();
        $size->setId('4307');
        $creative->setSize($size);

        // Upload the image asset.
        $image = Google::uploadAsset($service, Google::$user_id,
            '6900281', $image, 'HTML_IMAGE');
        $asset = new \Google_Service_Dfareporting_CreativeAsset();
        $asset->setAssetIdentifier($image->getAssetIdentifier());
        $asset->setRole('PRIMARY');

        // Add the creative asset.
        $creative->setCreativeAssets([$asset]);
        $result = $service->creatives->insert(Google::$user_id,
            $creative);
    }
}

<?php

namespace App\Http\Controllers\Trafficking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Google;

class CampaignController extends Controller
{
    function createCampaign(Request $request)
    {
        $service = new Google();
        $service = $service->googleClient();
        
        $startDate = new \DateTime('today');
        $endDate = new \DateTime('+1 month');

        $campaign = new \Google_Service_Dfareporting_Campaign();
        $campaign->setAdvertiserId('6900281');
        $campaign->setDefaultLandingPageId('22570943');
        $campaign->setName('API_TEST');
        $campaign->setStartDate($startDate->format('Y-m-d'));
        $campaign->setEndDate($endDate->format('Y-m-d'));
        $result = $service->campaigns->insert(
            Google::$user_id,
            $campaign
        );
    }

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

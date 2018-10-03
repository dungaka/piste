<?php

namespace App\Http\Controllers\Trafficking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Google;

class CreativeController extends Controller
{
    function createCreative()
    {

        $image = $_FILES['image'];
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

        // Associate the creative asset with a campaign.
        $association = new \Google_Service_Dfareporting_CampaignCreativeAssociation();
        $association->setCreativeId($result['id']);
        $result = $service->campaignCreativeAssociations->insert(
            Google::$user_id, '21781241', $association);
    }
}

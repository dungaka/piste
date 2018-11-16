<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public function insertion_orders()
    {
        return $this->hasMany(
            InsertionOrder::class,
            'dbm_campaign_id', 
            'dbm_campaign_id'
        );
    }

    public function client()
    {
        return $this->belongsTo(
            Client::class,
            'dbm_advertiser_id',
            'dbm_advertiser_id'
        );
    }

    protected $guarded = [];
}
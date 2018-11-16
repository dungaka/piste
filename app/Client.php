<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function campaigns()
    {
        return $this->hasMany(
            Campaign::class,
            'dbm_advertiser_id',
            'dbm_advertiser_id'
        );
    }

    protected $guarded = [];
}
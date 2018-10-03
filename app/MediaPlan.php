<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaPlan extends Model
{
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function insertion_order()
    {
        return $this->hasMany(InsertionOrder::class);
    }

    protected $guarded = [];
}
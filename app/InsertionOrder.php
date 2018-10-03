<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsertionOrder extends Model
{
    public function media_plan()
    {
        return $this->belongsTo(MediaPlan::class);
    }

    public function creatives()
    {
        return $this->belongstoMany(Creative::class);
    }

    protected $guarded = [];
}
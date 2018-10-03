<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function insertionOrder()
    {
        return $this->hasMany(Client::class);
    }

    protected $guarded = [];
}
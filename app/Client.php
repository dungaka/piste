<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function campaign()
    {
        return $this->hasMany(Campaign::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded = [];
}
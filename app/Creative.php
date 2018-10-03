<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creative extends Model
{
    public function line_items()
    {
        return $this->belongsToMany(LineItem::class);
    }

    protected $guarded = [];
}
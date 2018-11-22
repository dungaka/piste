<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsertionOrder extends Model
{
    public function insertion_order_budgets()
    {
        return $this->hasMany(Flight::class);
    }

    public function results()
    {
        return $this->hasMany(
            Result::class, 
            'dbm_insertion_order_id', 
            'dbm_insertion_order_id'
        );
    }

    public function campaign()
    {
        return $this->belongsTo(
            Campaign::class,
            'dbm_campaign_id',
            'dbm_campaign_id'
        );
    }

    /**
     * Scope a query to only include active insertion orders.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        $flights = Flight::active()->get();

        $insertion_order_ids = [];

        foreach($flights as $flight) {
            $insertion_order_ids[] = $flight->insertion_order->id;
        }

        return $query->whereIn('id', $insertion_order_ids);
    }

    protected $guarded = [];
}
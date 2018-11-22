<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];

    // Not sure if this locates the correct key
    public function insertion_order()
    {
        return $this->belongsTo(
            InsertionOrder::class,
            'dbm_insertion_order_id', 
            'dbm_insertion_order_id'
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
            $insertion_order_ids[] = $flight->insertion_order->dbm_insertion_order_id;
        }

        return $query->whereIn('dbm_insertion_order_id', $insertion_order_ids);
    }

    protected $guarded = [];
}
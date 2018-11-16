<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function cacheKey()
    {
        return sprintf(
            "%s/%s-%s",
            $this->getTable(),
            $this->getKey(),
            $this->updated_at->timestamp
        );
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'start',
        'end'
    ];

    public function insertion_order()
    {
        return $this->belongsTo(InsertionOrder::class);
    }

    /**
     * Scope a query to only include active insertion orders.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query
                ->whereDate('end', '>', Carbon::today()->subDays(7))
                ->where('amount_budgeted', '>', '2');
    }

    /**
     * Create calculated fields.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected $appends = ['lapsed', 'actual_spend_to_date', 'planned_spend_to_date', 'pace'];

    public function getLapsedAttribute()
    {
        return Cache::remember($this->cacheKey() . ':lapsed', 15, function () {

            $lapsed = $this->start->diffInDays(\Carbon\Carbon::today());
            if($lapsed > $this->duration) {
                $lapsed = $this->duration;
            }

            return $lapsed;
        });
    }

    public function getActualSpendToDateAttribute()
    {
        return Cache::remember($this->cacheKey() . ':actual_spend_to_date', 15, function () {

            $results = Result::active()->get();

            $flight_dates = CarbonPeriod::create(
                $this->start->subday(),
                $this->end
            )->toArray();

            $actual_spend_to_date = $results->where(
                                            'dbm_insertion_order_id',
                                            $this->insertion_order
                                                ->dbm_insertion_order_id
                                            )->whereIn('date', $flight_dates)
                                            ->sum->amount_spent;
            return $actual_spend_to_date;
        });
    }

    public function getPlannedSpendToDateAttribute()
    {
        return Cache::remember($this->cacheKey() . ':planned_spend_to_date', 15, function () {

            $planned_spend_to_date = $this->amount_budgeted;
            $planned_spend_to_date = $planned_spend_to_date / $this->duration * $this->getLapsedAttribute();

            return $planned_spend_to_date;
        });
    }

    public function getPaceAttribute()
    {
        return Cache::remember($this->cacheKey() . ':pace', 60, function () {
            $pace = (
                $this->getPlannedSpendToDateAttribute() - $this->getActualSpendToDateAttribute()
                ) / $this->getPlannedSpendToDateAttribute() * 100;
            return $pace;
        });
    }

    protected $guarded = [];
}
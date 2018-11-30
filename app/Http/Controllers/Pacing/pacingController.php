<?php

namespace App\Http\Controllers\Pacing;

use App\Client;
use App\Result;
use App\Flight;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class pacingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the path the user should be redirected to.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        return route('login');
    }

    /**
     * Show all clients and all of their information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flights = Flight::active()->get();
        
        return view('insertion_orders.index', compact('flights'));
    }

    /**
     * Show all clients and all of their information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function revenue()
    {
        $flights = Flight::active()->get();
        $month_start = new Carbon('first day of this month');
        $month_end = new Carbon('last day of this month');
        $flight_revenue = [];

        foreach($flights as $flight) {
            $flight_dates = CarbonPeriod::create(
                $flight->start->subday(),
                $flight->end
            )->toArray();

            $daily_spend = $flight->amount_budgeted / count($flight_dates);

            $flight_dates_this_month = [];
            foreach($flight_dates as $flight_date) {
                if($flight_date < $month_start) {

                }
                elseif($flight_date > $month_end) {

                }
                else {
                    $flight_dates_this_month[] = $flight_date;
                }
            }
            $flight_revenue[] = $daily_spend * count($flight_dates_this_month);
        }

        $spend = array_sum($flight_revenue);

        $revenue = ($spend * 1.3) - $spend;

        dd($revenue);
        
        return view('insertion_orders.revenue', compact('flights', 'flight_dates'));
    }
}
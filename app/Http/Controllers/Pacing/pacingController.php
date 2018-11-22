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
    public function flight()
    {
        $flights = Flight::active()->get();

        return view('insertion_orders.flight', compact('flights'));
    }

    /**
     * Show all clients and all of their information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $flights = Flight::active()->get();
        
        return view('insertion_orders.show', compact('flights'));
    }
}
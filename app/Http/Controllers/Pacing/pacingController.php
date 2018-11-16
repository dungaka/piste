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
    /**
     * Show all clients and all of their information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flights = Flight::active()->get();
        
        return view('insertion_orders.show', compact('flights'));
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
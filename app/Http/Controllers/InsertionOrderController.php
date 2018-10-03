<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InsertionOrder;

class InsertionOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insertion_orders = InsertionOrder::get();
        
        return view('insertion_orders.index', [
            'insertion_orders' => $insertion_orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('insertion_orders.create', [
            'insertion_order' => new InsertionOrder
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'insertion_order_id' => 'required', 
        ]);

        Line::create([
            'name' => request('name'),
            'insertion_order_id' => request('insertion_order_id'),
        ]);

        return redirect('insertion-orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  InsertionOrder $line
     * @return \Illuminate\Http\Response
     */
    public function show(InsertionOrder $insertion_order)
    {
        return view('insertion_orders.show', [
            'insertion_order' => $insertion_order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  InsertionOrder $line
     * @return \Illuminate\Http\Response
     */
    public function edit(InsertionOrder $insertion_order)
    {
        return view('insertion_orders.edit', [
            'insertion_order' => $insertion_order
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  InsertionOrder $line
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InsertionOrder $insertion_order)
    {
        $this->validate($request, [
            'name' => 'required',
            'insertion_order_id' => 'required',
        ]);

        $line->update([
            'name' => request('name'),

        ]);

        return redirect("insertion-orders/{$slug}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // IMPLEMENT
    }
}
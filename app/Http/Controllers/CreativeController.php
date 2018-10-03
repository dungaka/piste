<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Creative;

class CreativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creatives = Creative::get();
        
        return view('creatives.index', [
            'creatives' => $creatives
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('creatives.create', [
            'creative' => new Creative
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
            'ad_tag' => 'required',   
        ]);

        Creative::create([
            'ad_tag' => request('ad_tag'),
        ]);

        return redirect('creatives');
    }

    /**
     * Display the specified resource.
     *
     * @param  Creative $creative
     * @return \Illuminate\Http\Response
     */
    public function show(Creative $creative)
    {
        return view('creatives.show', [
            'creative' => $creative
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Creative $creative
     * @return \Illuminate\Http\Response
     */
    public function edit(Creative $creative)
    {
        return view('creatives.edit', [
            'creative' => $creative
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Creative $creative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Creative $creative)
    {
        $this->validate($request, [
            'ad_tag' => 'required',
        ]);

        $creative->update([
            'ad_tag' => request('ad_tag'),
        ]);

        return redirect("creatives/{ $creative->id }");
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
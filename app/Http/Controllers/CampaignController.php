<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::get();
        
        return view('campaigns.index', [
            'campaigns' => $campaigns
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('campaigns.create', [
            'campaign' => new Campaign
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
            'client_id' => 'integer',
            'dbm_id' => 'integer',
            'brightroll_id' => 'integer',
            'dcm_id' => 'integer',  
        ]);

        Campaign::create([
            'name' => request('name'),
            'client_id' => request('client_id'),
            'dbm_id' => request('dbm_id'),
            'brightroll_id' => request('brightroll_id'),
            'dcm_id' => request('dcm_id'), 
            'description' => request('description')
        ]);

        return redirect('campaigns');
    }

    /**
     * Display the specified resource.
     *
     * @param  Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        return view('campaigns.show', [
            'campaign' => $campaign
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('campaigns.edit', [
            'campaign' => $campaign
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $this->validate($request, [
            'name' => 'required',
            'client_id' => 'integer',
            'dbm_id' => 'integer',
            'brightroll_id' => 'integer',
            'dcm_id' => 'integer',  
        ]);

        $campaign->update([
            'name' => request('name'),
            'client_id' => request('client_id'),
            'dbm_id' => request('dbm_id'),
            'brightroll_id' => request('brightroll_id'),
            'dcm_id' => request('dcm_id'), 
            'description' => request('description')
        ]);

        return redirect("campaigns/{$slug}");
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
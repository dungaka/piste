<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MediaPlan;

class MediaPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media_plans = MediaPlan::get();
        
        return view('media_plans.index', [
            'media_plans' => $media_plans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('media_plans.create', [
            'media_plan' => new MediaPlan
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
            'campaign_id' => 'integer',
            'dbm_id' => 'integer',
            'brightroll_id' => 'integer',
            'dcm_id' => 'integer',  
        ]);

        MediaPlan::create([
            'name' => request('name'),
            'campaign_id' => request('campaign_id'),
            'dbm_id' => request('dbm_id'),
            'brightroll_id' => request('brightroll_id'),
            'dcm_id' => request('dcm_id'), 
            'description' => request('description')
        ]);

        return redirect('media-plans');
    }

    /**
     * Display the specified resource.
     *
     * @param  MediaPlan $media_plan
     * @return \Illuminate\Http\Response
     */
    public function show(MediaPlan $media_plan)
    {
        return view('media_plans.show', [
            'media_plan' => $media_plan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  MediaPlan $media_plan
     * @return \Illuminate\Http\Response
     */
    public function edit(MediaPlan $media_plan)
    {
        return view('media_plans.edit', [
            'media_plan' => $media_plan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  MediaPlan $media_plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MediaPlan $media_plan)
    {
        $this->validate($request, [
            'name' => 'required',
            'campaign_id' => 'integer',
            'dbm_id' => 'integer',
            'brightroll_id' => 'integer',
            'dcm_id' => 'integer',  
        ]);

        $media_plan->update([
            'name' => request('name'),
            'campaign_id' => request('campaign_id'),
            'dbm_id' => request('dbm_id'),
            'brightroll_id' => request('brightroll_id'),
            'dcm_id' => request('dcm_id'), 
            'description' => request('description')
        ]);

        return redirect("media-plans/{$slug}");
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
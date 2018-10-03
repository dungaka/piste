<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::get();
        
        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('clients.create', [
            'client' => new Client
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
            'dbm_id' => 'integer',
            'brightroll_id' => 'integer',
            'ad_server_id' => 'integer',     
        ]);

        Client::create([
            'name' => request('name'),
            'slug' => str_slug(request('name'), '-'),
            'dbm_id' => request('dbm_id'),
            'brightroll_id' => request('brightroll_id'),
            'ad_server_id' => request('ad_server_id'), 
        ]);

        return redirect('clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show', [
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->validate($request, [
            'name' => 'required',
            'dbm_id' => 'integer',
            'brightroll_id' => 'integer',
            'ad_server_id' => 'integer',  
        ]);

        $slug = str_slug(request('name'), '-');
        $client->update([
            'name' => request('name'),
            'slug' => $slug,
            'dbm_id' => request('dbm_id'),
            'brightroll_id' => request('brightroll_id'),
            'ad_server_id' => request('ad_server_id'), 
        ]);

        return redirect("clients/{$slug}");
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
@extends('layouts.layout')

@section('content')
    <div>
        <h1>Campaigns</h1>

        <hr>
        
        @foreach($campaigns as $campaign)
            <a href="/campaigns/{{ $campaign->id }}">
                <h2>{{ $campaign->name }}</h2>
            </a>
        @endforeach

    </div>
@endsection
@extends('layouts.layout')

@section('content')
    <div>
        <h1>{{ $campaign->name }}</h1>

        <h4>Client:         
            <a href="/clients/{{ $campaign->client->slug }}">
                {{ $campaign->client->name }}
            </a>
        </h4>
        
        <p>
            <a href="/campaigns/{{ $campaign->id }}/edit">Edit</a>
            <a href="/campaigns" class="button is-primary">Back</a>
        </p>

    </div>
@endsection
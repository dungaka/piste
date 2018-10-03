@extends('layouts.layout')

@section('content')
    <div>
        <h1>Clients</h1>

        <hr>
        
        @foreach($clients as $client)
            <a href="/clients/{{ $client->slug }}">
                <h2>{{ $client->name }}</h2>
            </a>

            <ul>
                @foreach($client->campaign as $campaign)
                    <li>
                        <a href="/campaigns/{{ $campaign->id }}">
                            {{ $campaign->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach

    </div>
@endsection
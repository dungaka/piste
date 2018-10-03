@extends('layouts.layout')

@section('content')
    <div>
        <h1>{{ $client->name }}</h1>

        <p>
            <a href="/clients/{{ $client->slug }}/edit">Edit</a>
            <a href="/clients" class="button is-primary">Back</a>
        </p>

    </div>
@endsection
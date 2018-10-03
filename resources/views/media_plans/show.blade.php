@extends('layouts.layout')

@section('content')
    <div>
        <h1>{{ $media_plan->name }}</h1>

        <h4>Campaign:         
            <a href="/campaigns/{{ $media_plan->campaign->id }}">
                {{ $media_plan->campaign->name }}
            </a>
        </h4>
        
        <p>
            <a href="/media-plans/{{ $media_plan->id }}/edit">Edit</a>
            <a href="/media-plans" class="button is-primary">Back</a>
        </p>

    </div>
@endsection
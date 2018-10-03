@extends('layouts.layout')

@section('content')
    <div>
        <h1>{{ $insertion_order->name }}</h1>
        <h3>{{ $insertion_order->media_plan->campaign->client->name }}</h3>
        <h4>Insertion Order:         
            <a href="/media-plans/{{ $media_plan->insertion_order->id }}">
                {{ $insertion_order->insertion_order->name }}
            </a>
        </h4>
        
        <p>
            <a href="/insertion-orders/{{ $insertion_order->id }}/edit">Edit</a>
            <a href="/insertion-orders" class="button is-primary">Back</a>
        </p>

    </div>
@endsection
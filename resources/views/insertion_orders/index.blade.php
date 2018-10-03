@extends('layouts.layout')

@section('content')
    <div>
        <h1>Insertion Orders</h1>

        <hr>
        
        @foreach($insertion_orders as $insertion_order)
            <a href="/insertion-orders/{{ $insertion_order->id }}">
                <h2>{{ $insertion_order->name }}</h2>
            </a>
        @endforeach

    </div>
@endsection
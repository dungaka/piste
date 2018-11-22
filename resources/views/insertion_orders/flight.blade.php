@extends('layouts.layout')

@section('content')

    @foreach($flights as $flight)
        <h3>{{ $flight->insertion_order->io_name }}</h3>
        <ul>
            <li>Planned Spend to Date: {{ $flight->planned_spend_to_date }}</li>
            <li>Actual Spend to Date: {{ $flight->actual_spend_to_date }}</li>
            <li>Pace: {{ $flight['pace'] }}</li>
            <li>Duration: {{ $flight->duration }}</li>
            <li>Lapsed: {{ $flight->lapsed }}</li>
            <li>Total Budget: {{ $flight->amount_budgeted }}</li>
        </ul>
    @endforeach

@endsection
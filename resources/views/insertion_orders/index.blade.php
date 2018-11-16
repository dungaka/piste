@extends('layouts.layout')

@section('content')
    <div>
        <h1>Insertion Orders</h1>

        <hr>

        @foreach($clients as $client)
            <h3>{{ $client->name }}</h3>
            @foreach($client->campaigns as $campaign)
                @foreach($campaign->insertion_orders as $insertion_order)
                    <h4>{{ $insertion_order->name }}</h4>
                    @foreach($insertion_order->insertion_order_budgets as $insertion_order_budget)
                        <h5>Flight {{ $loop->iteration }} | {{ $insertion_order_budget->start }} - {{ $insertion_order_budget->end }}</h5>
                        <ul>
                            <li>Budget: {{ $insertion_order_budget->amount_budgeted }}</li>
                        </ul>
                    @endforeach
                    @foreach($insertion_order->results as $result)
                        <h5>Result {{ $loop->iteration }}</h5>
                        <ul>
                            <li>Amount Spent: {{ $result->amount_spent }}</li>
                        </ul>
                    @endforeach
                @endforeach
            @endforeach
        @endforeach

    </div>
@endsection
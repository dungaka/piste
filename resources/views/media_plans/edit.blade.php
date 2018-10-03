@extends('layouts.layout')

@section('content')
    <div>
        <h1>Edit Insertion Order</h1>

        <hr>

        <form method="POST" action="/insertion-orders/{{ $insertion_orders->id }}">
            {{ method_field('PATCH') }}

            @include('planning.insertion_orders.partials.form', [
                'submitButtonText' => 'Update Insertion Order'
            ])

        </form>
    </div>
@endsection
@extends('layouts.layout')

@section('content')
    <div>
        <h1>Add Client</h1>

        <hr>

        <form method="POST" action="/insertion-orders">

            @include('insertion_orders.partials.form')

        </form>
    </div>
@endsection
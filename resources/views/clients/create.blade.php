@extends('layouts.layout')

@section('content')
    <div>
        <h1>Add Client</h1>

        <hr>

        <form method="POST" action="/clients">

            @include('clients.partials.form')

        </form>
    </div>
@endsection
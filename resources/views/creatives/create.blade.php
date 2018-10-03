@extends('layouts.layout')

@section('content')
    <div>
        <h1>Add Client</h1>

        <hr>

        <form method="POST" action="/campaigns">

            @include('campaigns.partials.form')

        </form>
    </div>
@endsection
@extends('layouts.layout')

@section('content')
    <div>
        <h1>Edit Client</h1>

        <hr>

        <form method="POST" action="/clients/{{ $client->slug }}">
            {{ method_field('PATCH') }}

            @include('clients.partials.form', [
                'submitButtonText' => 'Update Client'
            ])

        </form>
    </div>
@endsection
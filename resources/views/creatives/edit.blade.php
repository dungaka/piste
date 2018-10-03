@extends('layouts.layout')

@section('content')
    <div>
        <h1>Edit Campaign</h1>

        <hr>

        <form method="POST" action="/campaigns/{{ $campaign->id }}">
            {{ method_field('PATCH') }}

            @include('campaigns.partials.form', [
                'submitButtonText' => 'Update Campaign'
            ])

        </form>
    </div>
@endsection
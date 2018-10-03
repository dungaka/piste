@extends('layouts.layout')

@section('content')
    <div>
        <h1>Edit Line Item</h1>

        <hr>

        <form method="POST" action="/line-items/{{ $line_items->id }}">
            {{ method_field('PATCH') }}

            @include('line_items.partials.form', [
                'submitButtonText' => 'Update Line Item'
            ])

        </form>
    </div>
@endsection
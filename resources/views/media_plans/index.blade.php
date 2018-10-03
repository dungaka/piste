@extends('layouts.layout')

@section('content')
    <div>
        <h1>Insertion Orders</h1>

        <hr>
        
        @foreach($media_plans as $media_plan)
            <a href="/media-plans/{{ $media_plan->id }}">
                <h2>{{ $media_plan->name }}</h2>
            </a>
        @endforeach

    </div>
@endsection
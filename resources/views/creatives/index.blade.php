@extends('layouts.layout')

@section('content')
    <div>
        <h1>Creative</h1>

        <hr>
        
        @foreach($creatives as $creative)
            <div>{!! $creative->ad_tag !!}</div>
        @endforeach

    </div>
@endsection
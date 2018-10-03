@extends('layouts.layout')

@section('content')
    <div>
        <h1>
            Reports
            <a href="/reports/ad-server/create/standard" class="pull-right btn btn-default">
                Create Standard Report
            </a>
        </h1>
        <hr>
        
        @foreach($reports as $report)
            <a href="/reports/ad-server/{{ $report->id }}">
                <h2>{{ $report->name }}</h2>
            </a>
            <a href="/reports/ad-server/{{ $report->id }}/delete" class="btn btn-warning">Delete</a>
            <a href="/reports/ad-server/{{ $report->id }}" class="btn btn-default">Open Report</a>
        @endforeach

    </div>
@endsection
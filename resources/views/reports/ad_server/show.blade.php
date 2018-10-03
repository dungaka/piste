@extends('layouts.layout')

@section('content')
    <div>
        <h1>{{ $files }}</h1>

        <ul>
            @foreach($files as $file)
                <li>
                    {{ $file->fileName }} - 
                    <a href="/reports/ad-server/{{ $report_id }}/{{ $file->id }}/download" target="_blank">Download</a>
                </li>
            @endforeach
        </ul>
        
    </div>
@endsection
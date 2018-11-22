@extends('layouts.layout')

@section('content')
<table-component
    :data="{{ $flights }}"
    sort-by="pace"
    sort-order="asc"
>
    <table-column show="name" label="Flight Name"></table-column>
    <table-column show="planned_spend_to_date" label="Planned Spend to Date" data-type="numeric"></table-column>
    <table-column show="actual_spend_to_date" label="Actual Spend to Date" data-type="numeric"></table-column>
    <table-column show="pace" label="Pace" data-type="numeric"></table-column>
    <table-column show="duration" label="Duration" data-type="numeric"></table-column>
    <table-column show="lapsed" label="Lapsed" data-type="numeric"></table-column>
    <table-column show="amount_budgeted" label="Total Budget" data-type="numeric"></table-column>
</table-component> 

@endsection
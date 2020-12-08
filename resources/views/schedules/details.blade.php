@extends('layouts.master')

@section('content')

<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
    <schedules-details v-bind:schedule="{{$schedule}}"/>

@endsection
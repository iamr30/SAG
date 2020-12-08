@extends('layouts.master')

@section('content')

<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
    <levels-details v-bind:level="{{$level}}" v-bind:discipline="{{$discipline}}"/>
@endsection

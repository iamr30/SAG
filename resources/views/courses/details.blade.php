@extends('layouts.master')

@section('content')
<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
    <courses-details v-bind:course="{{$course}}"/>
@endsection
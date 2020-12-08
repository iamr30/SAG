@extends('layouts.master')

@section('content')
<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
    <schedules-create-edit v-bind:schedule="{{$schedule}}"/>
@endsection
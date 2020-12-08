@extends('layouts.master')

@section('content')
<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
    <courses-create-edit v-bind:course="{{$course}}"/>
@endsection
@extends('layouts.master')

@section('content')
<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
            <addcondonation-component  v-bind:editid="{{$editN}}"></addcondonation-component>


@endsection

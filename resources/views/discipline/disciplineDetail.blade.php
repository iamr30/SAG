@extends('layouts.master')

@section('content')
<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
            <detailsdiscipline-component v-bind:detailsid="{{$detailN}}"/>

@endsection

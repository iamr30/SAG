@extends('layouts.master')

@section('content')
<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
            <details-component v-bind:showpay="true" v-bind:detailsid="{{$detailN}}">
            </details-component>
      

@endsection

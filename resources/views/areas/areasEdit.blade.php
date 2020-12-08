@extends('layouts.master')

@section('content')
<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
            <addareas-component  v-bind:editid="{{$editN}}"></addareas-component>
  

@endsection

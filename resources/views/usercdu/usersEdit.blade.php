@extends('layouts.master')

@section('content')
<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
            <add-component  v-bind:editid="{{$editN}}"></add-component>
     
@endsection

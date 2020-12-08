@extends('layouts.master')

@section('content')
<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
    <levels-create-edit v-bind:level="{{$level}}"/>
@endsection

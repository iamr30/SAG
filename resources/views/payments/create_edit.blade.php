@extends('layouts.master')

@section('content')
    <payments-create-edit v-bind:payment="{{$payment}}">
@endsection

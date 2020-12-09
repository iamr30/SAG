@extends('layouts.master')

@section('content')
    <detail-payment-component v-bind:payment="{{$payment}}"></detail-payment-component>
@endsection

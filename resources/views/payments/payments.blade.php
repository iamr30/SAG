@extends('layouts.master')

@section('content')
    <my-payments-component route="{{route('payments.index')}}"></my-payments-component>
@endsection

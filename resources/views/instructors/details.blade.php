@extends('layouts.master')

@section('content')
    <detail-instructor-component v-bind:instructor="{{$instructor}}"></detail-instructor-component>
@endsection

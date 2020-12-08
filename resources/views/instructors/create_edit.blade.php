@extends('layouts.master')

@section('content')
    <form-instructor-component v-bind:instructor="{{$instructor}}" route="{{route('instructors.index')}}"></form-instructor-component>
@endsection

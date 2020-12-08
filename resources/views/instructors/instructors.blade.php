@extends('layouts.master')

@section('content')
    <my-instructors-component route="{{route('instructors.index')}}"></my-instructors-component>
@endsection

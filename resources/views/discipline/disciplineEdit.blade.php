@extends('layouts.master')

@section('content')
<link href="{{ asset('css/zeus.css') }}" rel="stylesheet">
            <adddiscipline-component  v-bind:editid="{{$editN}}"></adddiscipline-component>
@endsection

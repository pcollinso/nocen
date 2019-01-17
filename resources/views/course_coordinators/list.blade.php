@extends('layouts.vue-page')
@section('content')
    <Course-Coordinators :institution="{{ json_encode($institution) }}" />
@endsection

@extends('layouts.vue-page')
@section('content')
    <Course-Prerequisites :institution="{{ json_encode($institution) }}" />
@endsection

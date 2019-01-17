@extends('layouts.vue-page')
@section('content')
    <Course-Advisers
        :institution="{{ json_encode($institution) }}"
        :levels="{{ json_encode($levels) }}" />
@endsection

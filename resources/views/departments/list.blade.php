@extends('layouts.vue-page')
@section('content')
    <Departments :institution="{{ json_encode($institution) }}"  />
@endsection

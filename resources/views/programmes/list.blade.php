@extends('layouts.vue-page')
@section('content')
    <Programmes :institution="{{ json_encode($institution) }}"  />
@endsection

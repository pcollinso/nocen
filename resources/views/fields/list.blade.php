@extends('layouts.vue-page')
@section('content')
    <Fields :institution="{{ json_encode($institution) }}"  />
@endsection

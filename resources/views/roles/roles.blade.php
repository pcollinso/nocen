@extends('layouts.vue-page')
@section('content')
    <Roles :roles="{{ json_encode($roles) }}" />
@endsection

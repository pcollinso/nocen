@extends('layouts.vue-page')
@section('content')
    <Users :users-prop="{{ json_encode($users) }}" :institution="{{ json_encode($institution) }}" />
@endsection

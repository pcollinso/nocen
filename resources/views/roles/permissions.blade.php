@extends('layouts.vue-page')
@section('content')
    <Permissions :permissions="{{ json_encode($permissions) }}" />
@endsection

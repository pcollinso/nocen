@extends('layouts.vue-page')
@section('content')
    <default-permissions :roles="{{ json_encode($roles) }}" :permissions="{{ json_encode($permissions) }}" />
@endsection

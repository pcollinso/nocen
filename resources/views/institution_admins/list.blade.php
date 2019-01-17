@extends('layouts.vue-page')
@section('content')
    <Institution-Admins
        :users="{{ json_encode($users) }}"
        :institutions="{{ json_encode($institutions) }}" />
@endsection

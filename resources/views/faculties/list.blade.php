@extends('layouts.vue-page')
@section('content')
    <Faculties :institution="{{ json_encode($institution) }}"  />
@endsection

@extends('layouts.vue-page')
@section('content')
    <Courses
        :institution="{{ json_encode($institution) }}"
        :levels="{{ json_encode($levels) }}"
        :semesters="{{ json_encode($semesters) }}" />
@endsection

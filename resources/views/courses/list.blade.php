@extends('layouts.vue-page')
@section('content')
    <Courses
        :institution="{{ json_encode($institution) }}"
        :programmes="{{ json_encode($programmes) }}"
        :faculties="{{ json_encode($faculties) }}"
        :departments="{{ json_encode($departments) }}"
        :levels="{{ json_encode($levels) }}"
        :semesters="{{ json_encode($semesters) }}"
        :courses="{{ json_encode($courses) }}" />
@endsection

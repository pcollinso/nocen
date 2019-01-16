@extends('layouts.vue-page')
@section('content')
    <Institutions
        :states="{{ json_encode($states) }}"
        :lgas="{{ json_encode($lgas) }}"
        :towns="{{ json_encode($towns) }}"
        :institutions="{{ json_encode($institutions) }}"
        :institution-types="{{ json_encode($institutionTypes) }}" />
@endsection

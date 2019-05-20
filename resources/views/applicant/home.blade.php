@extends('layouts.vue-page')
@section('content')
    <application
      :genders="{{ json_encode($genders) }}"
      :countries="{{ json_encode($countries) }}"
      :states="{{ json_encode($states) }}"
      :lgas="{{ json_encode($lgas) }}"
      :religions="{{ json_encode($religions) }}"
      :olevels="{{ json_encode($olevels) }}"
      :applicant="{{ json_encode($applicant) }}" />
@endsection

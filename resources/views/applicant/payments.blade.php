@extends('layouts.vue-page')
@section('content')
    <payments
      :applicant="{{ json_encode($applicant) }}" />
@endsection

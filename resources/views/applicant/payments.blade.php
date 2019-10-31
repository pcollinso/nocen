@extends('layouts.vue-page')
@section('content')
  <payments
    response-url="{{ route('applicant.paymentresponse') }}"
    :applicant="{{ json_encode($applicant) }}" />
@endsection

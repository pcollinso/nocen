@extends('layouts.vue-page')
@section('content')
    <applications
      :subjects="{{ json_encode($subjects) }}"
      :grades="{{ json_encode($grades) }}"
      :institution="{{ json_encode($institution) }}"
      :applications="{{ json_encode($applications) }}" />
@endsection

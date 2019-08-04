@extends('layouts.print')
@section('content')
  <div class="row mt-4">
    <div class="col-md-6 offset-md-3">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <img class="rounded img" src="/storage/passports/{{ $applicant->passport }}" width="200" height="200">
        </div>
      </div>
      <div class="form-group">
        <label>Surname</label>
        <p>{{ $applicant->surname }}</p>
      </div>
      <div class="form-group">
        <label>First name</label>
        <p>{{ $applicant->first_name }}</p>
      </div>
      <div class="form-group">
        <label>Middle name</label>
        <p>{{ $applicant->middle_name }}</p>
      </div>
      <div class="form-group">
        <label>Gender</label>
        <p>{{ $applicant->gender->gender_name }}</p>
      </div>
      <div class="form-group">
        <label>Disabled?</label>
        <p>{{ $applicant->is_disabled ? 'YES' : 'NO' }}</p>
      </div>
      <div class="form-group">
        <label>Religion</label>
        <p>{{ $applicant->religion->religion_name }}</p>
      </div>
      <div class="form-group">
        <label>Nationality</label>
        <p>{{ $applicant->nationality->country }}</p>
      </div>
      <div class="form-group">
        <label>State of origin</label>
        <p>{{ $applicant->state->state }}</p>
      </div>
      <div class="form-group">
        <label>LGA</label>
        <p>{{ $applicant->lga->name }}</p>
      </div>
      @if($applicant->town)
      <div class="form-group">
        <label>Town</label>
        <p>{{ $applicant->town->town }}</p>
      </div>
      @endif
      <div class="form-group">
        <label>Date of birth</label>
        <p>{{ $applicant->dob }}</p>
      </div>
    </div>
  </div>
  <script>
    window.print();
  </script>
@endsection

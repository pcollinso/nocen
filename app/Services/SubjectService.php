<?php

namespace App\Services;
use App\Models\Subject;

class SubjectService
{
  public function getAll()
  {
    return Subject::all()->all();
  }

  public function getById($id)
  {
    return Subject::find($id);
  }

  public function getByName($name)
  {
    return Subject::where('subject_name', $name)->first();
  }

  public function getByCode($code)
  {
    return Subject::where('subject_code', $code)->first();
  }

  public function create($attrs)
  {
    $existingSubject = Subject::where('subject_name', strtoupper($attrs['subject_name']))
      ->orWhere('subject_code', strtoupper($attrs['subject_code']))->first();
    if ($existingSubject) return $existingSubject;

    Subject::unguard();
    $subject = Subject::create($attrs);
    Subject::reguard();
    return $subject;
  }

}

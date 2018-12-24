<?php

namespace App\Services;
use App\Models\Subject;

class SubjectService
{
  public function getSubjects()
  {
    return Subject::all()->all();
  }

  public function getSubjectById($id)
  {
    return Subject::find($id);
  }

  public function getSubjectByName($name)
  {
    return Subject::where('subject_name', $name)->first();
  }

  public function getSubjectByCode($code)
  {
    return Subject::where('subject_code', $code)->first();
  }

  public function createSubject($attrs)
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

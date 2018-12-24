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
    $existingSubject = $this->getSubjectByName(strtoupper($attrs['subject_name']));
    if ($existingSubject) return $existingSubject;

    $existingSubject = $this->getSubjectByCode(strtoupper($attrs['subject_code']));
    if ($existingSubject) return $existingSubject;

    Subject::unguard();
    $subject = Subject::create($attrs);
    Subject::reguard();
    return $subject;
  }

}

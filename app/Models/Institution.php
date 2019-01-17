<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
  protected $table = 'sup_institution';

  public function institution_type()
  {
      return $this->belongsTo(InstitutionType::class);
  }

  public function users()
  {
      return $this->hasMany(User::class);
  }

  public function courses()
  {
      return $this->hasMany(Course::class);
  }

  public function programmes()
  {
      return $this->hasMany(Programme::class);
  }

  public function faculties()
  {
      return $this->hasMany(Faculty::class);
  }

  public function departments()
  {
      return $this->hasMany(Department::class);
  }

  public function course_coordinators()
  {
      return $this->hasMany(CourseCoordinator::class);
  }

  public function staff()
  {
      return $this->hasMany(Staff::class);
  }
}

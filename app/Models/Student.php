<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $guard = 'web';
    protected $table = 'sch_student_bio';
    protected $hidden = [
        'user_password', 'remember_token',
    ];
    protected $appends = ['full_name'];

    public function getAuthIdentifierName()
    {
        return 'regno';
    }

    public function getAuthIdentifier()
    {
        return $this->regno;
    }

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function getFullNameAttribute()
    {
        return $this->stud_middle_name ? "{$this->stud_first_name} {$this->stud_middle_name} {$this->stud_surname}" : "{$this->stud_first_name} {$this->stud_surname}";
    }
}

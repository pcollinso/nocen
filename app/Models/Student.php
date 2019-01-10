<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $guard = 'student';
    protected $table = 'sch_student_bio';
    protected $hidden = [
        'user_password', 'remember_token',
    ];

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
}

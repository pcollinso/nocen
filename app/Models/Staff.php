<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $guard = 'web';
    protected $table = 'sch_staff';
    protected $hidden = [
        'user_password', 'remember_token',
    ];
    protected $appends = ['full_name'];

    public function getAuthIdentifierName()
    {
        return 'verification_no';
    }

    public function getAuthIdentifier()
    {
        return $this->verification_no;
    }

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function getFullNameAttribute()
    {
        return $this->stud_middle_name ? "{$this->staff_first_name} {$this->staff_middle_name} {$this->staff_surname}" : "{$this->staff_first_name} {$this->staff_surname}";
    }
}

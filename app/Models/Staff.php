<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $guard = 'staff';
    protected $table = 'sch_staff';
    protected $hidden = [
        'user_password', 'remember_token',
    ];

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
}

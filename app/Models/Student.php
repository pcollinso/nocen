<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\HasPermissions;

class Student extends Authenticatable
{
    use HasPermissions;

    protected $guard = 'web';
    protected $table = 'sch_student_bio';
    protected $hidden = [
        'user_password', 'remember_token',
    ];
    protected $appends = ['full_name'];

    protected $roles_table = 'student_roles';
    protected $permissions_table = 'student_permissions';

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
        return $this->middle_name ? "$this->first_name $this->middle_name $this->surname" : "$this->first_name $this->surname";
    }
}

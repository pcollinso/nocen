<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    public function roles()
    {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_permissions');
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class,'staff_permissions');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class,'student_permissions');
    }
}

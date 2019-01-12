<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_roles');
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class,'staff_roles');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class,'student_roles');
    }
}

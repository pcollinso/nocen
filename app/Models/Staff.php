<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\HasPermissions;

class Staff extends Authenticatable
{
    use HasPermissions;

    protected $guard = 'web';
    protected $table = 'sch_staff';
    protected $hidden = [
        'user_password', 'remember_token',
    ];
    protected $appends = ['full_name'];

    protected $roles_table = 'staff_roles';
    protected $permissions_table = 'staff_permissions';

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

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function course_coordinators()
    {
        return $this->hasMany(CourseCoordinator::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}

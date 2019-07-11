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

    public function getUserTypeAttribute()
    {
        return "student";
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function nextOfKins()
    {
        return $this->hasMany(StudentNextOfKin::class, 'student_id', 'id');
    }

    public function olevelResults()
    {
        return $this->hasMany(StudentOlevelResult::class, 'student_id', 'id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'regno', 'regno');
    }

}

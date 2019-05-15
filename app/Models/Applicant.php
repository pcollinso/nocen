<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\HasPermissions;

class Applicant extends Authenticatable
{
    use HasPermissions;

    protected $guard = 'web';
    protected $table = 'sch_application_bio';
    protected $hidden = ['user_password'];
    protected $guarded = [];
    protected $appends = ['full_name'];

    protected $roles_table = 'applicant_roles';
    protected $permissions_table = 'applicant_permissions';

    public function getAuthIdentifierName()
    {
      return 'j_regno';
    }

    public function nextOfKins()
    {
      return $this->hasMany(NextOfKin::class, 'application_id', 'id');
    }

    public function getAuthIdentifier()
    {
        return $this->j_regno;
    }

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function getFullNameAttribute()
    {
      return $this->first_name .  (!empty($this->middle_name) ? " $this->middle_name" : "") . " $this->surname";
    }

    public static function phoneExists($inst, $phone)
    {
      return Applicant::where('institution_id', $inst)->where('phone', $phone)->exists();
    }

    public static function emailExists($inst, $email)
    {
      return Applicant::where('institution_id', $inst)->where('email', $email)->exists();
    }

    public static function regNoExists($inst, $regno)
    {
      return Applicant::where('institution_id', $inst)->where('j_regno', $regno)->exists();
    }

    public static function createApplicant($data)
    {
      $applicant = Applicant::create($data);
      $applicant->roles()->attach(Role::where('name', 'applicant')->first());
      return $applicant;
    }
}

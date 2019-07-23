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
    protected $appends = [
      'full_name',
      'application_fee',
      'post_utme_fee',
      'acceptance_fee'
    ];

    protected $roles_table = 'applicant_roles';
    protected $permissions_table = 'applicant_permissions';

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function admission()
    {
        return $this->hasOne(Admission::class, 'application_id', 'id');
    }

    public function nextOfKins()
    {
      return $this->hasMany(NextOfKin::class, 'application_id', 'id');
    }

    public function olevelResults()
    {
      return $this->hasMany(OlevelResult::class, 'application_id', 'id');
    }

    public function utme()
    {
      return $this->hasOne(UtmeResult::class, 'application_id', 'id');
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
      return $this->hasMany(Payment::class, 'j_regno', 'j_regno');
    }

    public function getAuthIdentifierName()
    {
      return 'j_regno';
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

    public function getApplicationFeeAttribute()
    {
      return $this->payments->where('fee_id', 1)->first();
    }

    public function getPostUtmeFeeAttribute()
    {
      return $this->payments->where('fee_id', 2)->first();
    }

    public function getAcceptanceFeeAttribute()
    {
      return $this->payments->where('fee_id', 3)->first();
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

    public function getUserTypeAttribute()
    {
        return "applicant";
    }

}

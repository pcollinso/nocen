<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\HasPermissions;

class User extends Authenticatable
{
    use HasPermissions;

    protected $guard = 'web';
    protected $table = 'sup_users';
    protected $hidden = [
        'user_password', 'remember_token',
    ];
    protected $appends = ['full_name'];

    protected $roles_table = 'user_roles';
    protected $permissions_table = 'user_permissions';

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getAuthIdentifier()
    {
        return $this->username;
    }

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function getFullNameAttribute()
    {
        return $this->name;
    }
}

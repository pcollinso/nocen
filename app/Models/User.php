<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    protected $table = 'sup_users';

    public function getAuthPassword() {
        $this->hash_code;
    }
}

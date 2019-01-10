<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Validator;
use App\Utils\Passcode;
use App\Models\User;
use App\Models\Staff;
use App\Models\Student;

class CustomUserProvider extends EloquentUserProvider
{

    public function retrieveById($identifier, $type = 'user')
	{
        if ($type === 'user') return User::find($identifier);
        if ($type === 'staff') return Staff::find($identifier);
        if ($type === 'student') return Student::find($identifier);
        return null;
	}

    public function retrieveByCredentials(array $credentials)
    {
        $user = User::where('phone', $credentials['login'])->first();
        if ($user) return $user;

        $user = User::where('email', $credentials['login'])->first();
        if ($user) return $user;

        $user = Staff::where('verification_no', $credentials['login'])->first();
        if ($user) return $user;

        $user = Student::where('regno', $credentials['login'])->first();
        return $user;
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        return Passcode::checkPassword($credentials['password'], $user->getAuthPassword());
    }
}

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
    public function retrieveByToken($identifier, $token)
    {
        $model = $this->retrieveById($identifier);

        if (! $model) {
            return null;
        }

        $rememberToken = $model->getRememberToken();

        return $rememberToken && hash_equals($rememberToken, $token) ? $model : null;
    }

    public function retrieveById($identifier)
	{
        return $this->retrieveByCredentials(['login' => $identifier]);
	}

    public function retrieveByCredentials(array $credentials)
    {
        $user = User::where((new User)->getAuthIdentifierName(), $credentials['login'])->first();
        if ($user) return $user;

        $user = Staff::where((new Staff)->getAuthIdentifierName(), $credentials['login'])->first();
        if ($user) return $user;

        return Student::where((new Student)->getAuthIdentifierName(), $credentials['login'])->first();
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        return Passcode::checkPassword($credentials['password'], $user->getAuthPassword());
    }
}

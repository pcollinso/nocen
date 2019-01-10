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
        if (!$this->credentialTypeValid($credentials)) return null;

        if ($credentials['type'] === 'user') {
            if (isset($credentials['phone'])) return User::where('phone', $credentials['phone'])->first();
            if (isset($credentials['email'])) return User::where('email', $credentials['email'])->first();
        }

        if ($credentials['type'] === 'staff' && isset($credentials['staff_code'])) {
            return Staff::where('verification_no', $credentials['staff_code'])->first();
        }

        if ($credentials['type'] === 'student' && isset($credentials['regno'])) {
            return Staff::where('regno', $credentials['regno'])->first();
        }

        return null;
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        return Passcode::checkPassword($credentials['password'], $user->getAuthPassword());
    }

    private function credentialTypeValid($credentials) {
        $validator = Validator::make($credentials, ['type' => 'required|in:user,staff,student']);
        return !$validator->fails();
    }
}

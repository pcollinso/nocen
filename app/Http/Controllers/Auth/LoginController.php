<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Route;
use App\Http\Controllers\Controller;
use App\Utils\Passcode;

class LoginController extends Controller
{

    public function login()
    {
        $errorMsg = '';

        if ($this->request->isMethod('post')) {
            $creds = array_intersect_key($this->request->all(), ['login' => 1, 'password' => 1]);
            $user = $this->userProvider->retrieveByCredentials($creds);
            $creds['remember'] = (bool) $this->request->input('remember');

            if ($user) {
                if (Auth::attempt($creds, $creds['remember'])) {
                    return redirect('dashboard');
                }
            } else {
                $errorMsg = 'User not found';
            }
        }

        return view('auth.login', ['errorMsg' => $errorMsg]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function checkUser()
    {
        $data = $this->userProvider->retrieveByCredentials(['login' => $this->request->input('login')]);
        return response()->json(['success' => (bool) $data, 'data' => $data], 200);
    }

    public function changePassword()
    {
        $errorMsg = '';

        if ($this->request->isMethod('post')) {
            $data = $this->request->only('user_password', 'new_password');
            $validator = Validator::make($data, [
                'user_password' => 'required|string|between:6,300',
                'new_password' => 'required|string|between:6,300'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'data' => $validator->errors()->messages()
                ], 422);
            }

            $user = auth()->user();

            if (! $this->userProvider->validateCredentials($user, ['password' => $data['user_password']]))
            {
                $errorMsg = 'Current password not valid';
            } else
            {
                $user->user_password = Passcode::hashPassword($data['new_password']);
                $user->save();
                return redirect('dashboard');
            }

        }
        return view('auth.change-password', ['errorMsg' => $errorMsg]);

    }
}

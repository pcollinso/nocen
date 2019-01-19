<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\Institution;
use App\Models\User;
use App\Models\Role;
use App\Utils\Passcode;

class InstitutionAdminController extends Controller
{
  public function index()
  {
    $users = User::all()
      ->load('roles')
      ->filter(function ($user) {
        return $user->hasRole(Role::$institutionadmin);
      })
      ->toArray();

    return view('institution_admins.list', [
      'institutions' => Institution::all(),
      'users' => array_values($users),
    ]);
  }

  public function update($id)
  {
    $data = $this->request->all();
    $validator = Validator::make($data, [
        'institution_id' => 'exists:sup_institution,id',
        'name' => 'string|max:156',
        'username' => [
          'string',
          'max:45',
          Rule::unique('sup_users')->ignore($id)
        ],
        'email' => [
          'email',
          'max:165',
          Rule::unique('sup_users')->ignore($id)
        ],
        'phone' => [
          'regex:/^\d{7,11}$/',
          'max:15',
          Rule::unique('sup_users')->ignore($id)
        ]
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => $validator->errors()->messages()
        ], 422);
    }

    User::unguard();
    $user = User::find($id)->fill($data);
    User::reguard();
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'Institution admin updated',
        'data' => $user
    ]);
  }

  public function create()
  {
    $data = $this->request->all();
    if (isset($data['user_password']))
    {
      $data['user_password'] = Passcode::hashPassword($data['user_password']);
    }

    $validator = Validator::make($data, [
      'institution_id' => 'required|exists:sup_institution,id',
      'name' => 'required|string|max:156',
      'username' => 'required|string|max:45|unique:sup_users',
      'email' => 'required|email|max:165|unique:sup_users',
      'phone' => 'regex:/^\d{7,11}$/|max:15|unique:sup_users'
    ]);
    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    User::unguard();
    $user = new User($data);
    User::reguard();
    $user->save();

    $instAdminRole = Role::where('name', Role::$institutionadmin)->first();
    $user->roles()->attach($instAdminRole);
    $user->permissions()->attach($instAdminRole->permissions()->get());

    return response()->json([
        'success' => true,
        'message' => 'Institution admin created',
        'data' => $user
    ]);
  }
}

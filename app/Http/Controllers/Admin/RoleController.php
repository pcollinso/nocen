<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Validator;

class RoleController extends Controller
{

    public function index()
    {
        return view('roles.roles', ['roles' => Role::all()]);
    }

    public function defaultPermissions()
    {
        return view('roles.default-perms', ['roles' => Role::all()->load('permissions'), 'permissions' => Permission::all()]);
    }

    public function create(Request $request)
    {
        $data = array_intersect_key($request->all(), ['name' => 1]);
        $validator = Validator::make($data, [
            'name' => 'required|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors.',
                'data' => $validator->errors()->messages()
            ], 422);
        }

        $role = new Role;
        $role->name = $data['name'];
        $role->save();

        return response()->json([
            'success' => true,
            'message' => 'Role created',
            'data' => $role
        ]);
    }

    public function assignPermissions(Request $request)
    {
        $data = array_intersect_key($request->all(), ['role' => 1, 'permissions' => 1]);
        $validator = Validator::make($data, [
            'role' => 'required|array',
            'permissions' => 'array'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors.',
                'data' => $validator->errors()->messages()
            ], 422);
        }

        Role::unguard();
        $role = new Role($data['role']);
        Role::reguard();

        $permissionIds = array_map(function ($perm) {
            return $perm['id'];
        }, $data['permissions']);

        $role->permissions()->sync($permissionIds);

        return response()->json([
            'success' => true,
            'message' => 'Role permissions updated',
            'data' => $role->load('permissions')
        ]);
    }

    public function delete($id)
    {
        return response()->json([
            'success' => (bool) Role::destroy($id)
        ]);
    }
}

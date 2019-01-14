<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Validator;

class PermissionController extends Controller
{

    public function index()
    {
        return view('roles.permissions', ['permissions' => Permission::all()]);
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

        $role = new Permission;
        $role->name = $data['name'];
        $role->save();

        return response()->json([
            'success' => true,
            'message' => 'Permission created',
            'data' => $role
        ]);
    }

    public function delete($id)
    {
        return response()->json([
            'success' => (bool) Permission::destroy($id)
        ]);
    }
}

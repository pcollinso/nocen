<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\InstitutionType;
use App\Models\State;
use App\Models\Lga;
use App\Models\Town;
use Validator;
use Illuminate\Validation\Rule;

class InstitutionController extends Controller
{
    public function index()
    {
        return view('institutions.list', [
          'institutions' => Institution::all()->load('institution_type'),
          'institutionTypes' => InstitutionType::all(),
          'states' => State::all(),
          'lgas' => Lga::all(),
          'towns' => Town::all(),
        ]);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'institution_type_id' => 'exists:sch_institution_type,id',
            'address' => 'string|max:125',
            'city' => 'string|max:45|exists:sup_town,town',
            'state' => 'string|max:45|exists:sup_state,state',
            'lga' => 'string|max:45|exists:sup_lga,name',
            'institution_code' => [
              'string',
              'max:20',
              Rule::unique('sup_institution')->ignore($id)
            ],
            'institution_name' => [
              'string',
              'max:45',
              Rule::unique('sup_institution')->ignore($id)
            ],
            'email' => [
              'email',
              'max:165',
              Rule::unique('sup_institution')->ignore($id)
            ],
            'phone' => [
              'regex:/^\d{7,11}$/',
              'max:15',
              Rule::unique('sup_institution')->ignore($id)
            ]
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'data' => $validator->errors()->messages()
            ], 422);
        }

        $inst = Institution::find($id);
        Institution::unguard();
        $inst->fill($data);
        Institution::reguard();
        $inst->save();

        return response()->json([
            'success' => true,
            'message' => 'Institution updated',
            'data' => $inst->load('institution_type')
        ]);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'institution_code' => 'required|string|max:20|unique:sup_institution',
            'institution_name' => 'required|string|max:45|unique:sup_institution',
            'institution_type_id' => 'required|exists:sch_institution_type,id',
            'address' => 'string|max:125',
            'city' => 'string|max:45|exists:sup_town,town',
            'state' => 'required|string|max:45|exists:sup_state,state',
            'lga' => 'required|string|max:45|exists:sup_lga,name',
            'email' => 'required|email|max:165|unique:sup_institution',
            'phone' => 'regex:/^\d{7,11}$/|max:15|unique:sup_institution'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'data' => $validator->errors()->messages()
            ], 422);
        }

        Institution::unguard();
        $inst = new Institution($data);
        Institution::reguard();
        $inst->save();

        return response()->json([
            'success' => true,
            'message' => 'Institution created',
            'data' => $inst->load('institution_type')
        ]);
    }
}

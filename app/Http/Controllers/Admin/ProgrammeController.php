<?php
namespace App\Http\Controllers\Admin;
use Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Programme;

class ProgrammeController extends Controller
{
  public function index()
  {
    $institution = auth()->user()
      ->institution()
      ->first()
      ->load('programmes');

    return view('programmes.list', [
      'institution' => $institution
    ]);
  }

  public function update($id)
  {
    $data = $this->request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'exists:sup_institution,id',
      'programme_name' => [
        'string',
        'max:200',
        Rule::unique('sch_programme')->ignore($id)
      ]
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => $validator->errors()->messages()
        ], 422);
    }

    Programme::unguard();
    $programme = Programme::find($id)->fill($data);
    Programme::reguard();
    $programme->save();

    return response()->json([
        'success' => true,
        'message' => 'Programme updated',
        'data' => $programme
    ]);
  }

  public function create()
  {
    $data = $this->request->all();
    $validator = Validator::make($data, [
      'institution_id' => 'required|exists:sup_institution,id',
      'programme_name' => 'required|max:200|unique:sch_programme',
    ]);
    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validation failed',
        'data' => $validator->errors()->messages()
      ], 422);
    }

    Programme::unguard();
    $programme = new Programme($data);
    Programme::reguard();
    $programme->save();

    return response()->json([
        'success' => true,
        'message' => 'Programme created',
        'data' => $programme
    ]);
  }

  public function delete($id)
  {
    $success = (bool) Programme::destroy($id);
    return response()->json([
      'success' => $success,
      'message' => $success ? 'Programme deleted' : 'Could not delete programme'
  ]);
  }
}

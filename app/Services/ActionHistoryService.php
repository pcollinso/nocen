<?php

namespace App\Services;
use App\Models\ActionHistory;

class ActionHistoryService
{
  public function getAll()
  {
    return ActionHistory::all()->all();
  }

  public function getById($id)
  {
    return ActionHistory::find($id);
  }

  public function getByUser($id)
  {
    return ActionHistory::where('user_id', $id)->get()->all();
  }

  public function create($attrs)
  {
    if (!isset($attrs['institution_id'])) return 'Provide institution id';
    if (!isset($attrs['user_id'])) return 'Provide user id';
    ActionHistory::unguard();
    $ah = ActionHistory::create($attrs);
    ActionHistory::reguard();
    return $ah;
  }

}

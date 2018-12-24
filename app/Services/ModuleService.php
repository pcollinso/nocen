<?php

namespace App\Services;
use App\Models\Module;

class ModuleService
{
  public function getAll()
  {
    return Module::all()->all();
  }

  public function getById($id)
  {
    return Module::find($id);
  }

  public function getByName($name)
  {
    return Module::where('module_name', $name)->first();
  }

  public function create($attrs)
  {
    $existingModule = $this->getByName(strtoupper($attrs['module_name']));
    if ($existingModule) return $existingModule;
    Module::unguard();
    $module = Module::create($attrs);
    Module::reguard();
    return $module;
  }

}

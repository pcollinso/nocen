<?php

namespace App\Services;
use App\Models\Module;

class ModuleService
{
  public function getModules()
  {
    return Module::all()->all();
  }

  public function getModuleById($id)
  {
    return Module::find($id);
  }

  public function getModuleByName($name)
  {
    return Module::where('module_name', $name)->first();
  }

  public function createModule($attrs)
  {
    $existingModule = $this->getModuleByName(strtoupper($attrs['module_name']));
    if ($existingModule) return $existingModule;
    Module::unguard();
    $module = Module::create($attrs);
    Module::reguard();
    return $module;
  }

}

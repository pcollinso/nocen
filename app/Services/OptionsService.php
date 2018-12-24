<?php

namespace App\Services;
use App\Models\Country;
use App\Models\State;
use App\Models\Lga;
use App\Models\Town;
use App\Models\OlevelGrade;
use App\Models\Gender;
use App\Models\Mode;
use App\Models\Religion;
use App\Models\Title;
use App\Models\Semester;
use App\Models\Qualification;
use App\Models\GlobalSetting;

class OptionsService
{
  public function getCountries()
  {
    return Country::all()->all();
  }

  public function getCountryById($id)
  {
    return Country::find($id);
  }

  public function getCountryByName($name)
  {
    return Country::where('country', $name)->first();
  }

  public function getStates()
  {
    return State::all()->all();
  }

  public function getStateById($id)
  {
    return State::find($id);
  }

  public function getStatesByCountry($id)
  {
    return State::where('country_id', $id)->get()->all();
  }

  public function getStateByName($name)
  {
    return State::where('state', $name)->first();
  }

  public function getLgas()
  {
    return Lga::all()->all();
  }

  public function getLgaById($id)
  {
    return Lga::find($id);
  }

  public function getLgasByState($id)
  {
    return Lga::where('state_id', $id)->get()->all();
  }

  public function getLgasByCountry($id)
  {
    return Lga::where('country_id', $id)->get()->all();
  }

  public function getTowns()
  {
    return Town::all()->all();
  }

  public function getTownById($id)
  {
    return Town::find($id);
  }

  public function getTownsByStateId($id)
  {
    return Town::where('state_id', $id)->get()->all();
  }

  public function getTownsByStateName($name)
  {
    return Town::where('state', $name)->get()->all();
  }

  public function getTownsByLgaId($id)
  {
    return Town::where('lga_id', $id)->get()->all();
  }

  public function getTownsByLgaName($name)
  {
    return Town::where('lga', $name)->get()->all();
  }

  public function getOlevelGrades()
  {
    return OlevelGrade::all()->all();
  }

  public function getGenders()
  {
    return Gender::all()->all();
  }

  public function getModes()
  {
    return Mode::all()->all();
  }

  public function getReligions()
  {
    return Religion::all()->all();
  }

  public function getTitles()
  {
    return Title::all()->all();
  }

  public function getSemesters()
  {
    return Semester::all()->all();
  }

  public function getQualifications()
  {
    return Qualification::all()->all();
  }

  public function getGlobalSettings()
  {
    return GlobalSetting::all()->all();
  }
}

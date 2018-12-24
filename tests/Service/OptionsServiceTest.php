<?php

namespace Tests\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\OptionsService;
use Artisan;

class OptionsServiceTest extends TestCase
{
    use RefreshDatabase;

    const COUNTRY_ID = 3;
    const STATE_ID = 1;
    const LGA_ID = 1;
    const TOWN_ID = 1;
    const COUNTRY = 'Nigeria';
    const STATE = 'ABIA';
    const LGA = 'ABA NORTH';

    public function setUp()
    {
        parent::setUp();
        $this->optionsService = app()->make(OptionsService::class);
        Artisan::call('db:seed');
    }

    public function testGetCountries()
    {
        $countries = $this->optionsService->getCountries();
        $this->assertTrue(is_array($countries));
        $this->assertGreaterThan(0, count($countries));
    }

    public function testGetCountryById()
    {
        $country = $this->optionsService->getCountryById(self::COUNTRY_ID);
        $this->assertArrayHasKey('country', $country->getAttributes());
        $this->assertEquals(self::COUNTRY_ID, $country->getAttributes()['id']);
    }

    public function testGetCountryByName()
    {
        $country = $this->optionsService->getCountryByName(self::COUNTRY);
        $this->assertArrayHasKey('country', $country->getAttributes());
        $this->assertEquals(self::COUNTRY, $country->getAttributes()['country']);
    }

    public function testGetStates()
    {
        $states = $this->optionsService->getStates();
        $this->assertTrue(is_array($states));
    }

    public function testGetStateById()
    {
        $state = $this->optionsService->getStateById(self::STATE_ID);
        $this->assertArrayHasKey('state', $state->getAttributes());
        $this->assertEquals(self::STATE_ID, $state->getAttributes()['id']);
    }

    public function testGetStatesByCountry()
    {
        $states = $this->optionsService->getStatesByCountry(self::COUNTRY_ID);
        $this->assertTrue(is_array($states));
        $this->assertGreaterThan(0, count($states));
        $this->assertEquals(self::COUNTRY_ID, $states[0]->getAttributes()['country_id']);
    }

    public function testGetStateByName()
    {
        $state = $this->optionsService->getStateByName(self::STATE);
        $this->assertArrayHasKey('state', $state->getAttributes());
        $this->assertEquals(self::STATE, $state->getAttributes()['state']);
    }

    public function testGetLgas()
    {
        $lgas = $this->optionsService->getLgas();
        $this->assertTrue(is_array($lgas));
    }

    public function testGetLgaById()
    {
        $lga = $this->optionsService->getLgaById(self::LGA_ID);
        $this->assertArrayHasKey('name', $lga->getAttributes());
        $this->assertEquals(self::LGA_ID, $lga->getAttributes()['id']);
    }

    public function testGetLgasByState()
    {
        $lgas = $this->optionsService->getLgasByState(self::STATE_ID);
        $this->assertTrue(is_array($lgas));
        $this->assertGreaterThan(0, count($lgas));
        $this->assertEquals(self::STATE_ID, $lgas[0]->getAttributes()['state_id']);
    }

    public function testGetLgasByCountry()
    {
        $lgas = $this->optionsService->getLgasByCountry(self::COUNTRY_ID);
        $this->assertTrue(is_array($lgas));
        $this->assertGreaterThan(0, count($lgas));
        $this->assertEquals(self::COUNTRY_ID, $lgas[0]->getAttributes()['country_id']);
    }

    public function testGetTowns()
    {
        $towns = $this->optionsService->getTowns();
        $this->assertTrue(is_array($towns));
    }

    public function testGetTownById()
    {
        $town = $this->optionsService->getTownById(self::TOWN_ID);
        $this->assertArrayHasKey('town', $town->getAttributes());
        $this->assertEquals(self::TOWN_ID, $town->getAttributes()['id']);
    }

    public function testGetTownsByStateId()
    {
        $towns = $this->optionsService->getTownsByStateId(self::STATE_ID);
        $this->assertTrue(is_array($towns));
        $this->assertGreaterThan(0, count($towns));
        $this->assertEquals(self::STATE_ID, $towns[0]->getAttributes()['state_id']);
    }

    public function testGetTownsByStateName()
    {
        $towns = $this->optionsService->getTownsByStateName(self::STATE);
        $this->assertTrue(is_array($towns));
        $this->assertGreaterThan(0, count($towns));
        $this->assertEquals(self::STATE, $towns[0]->getAttributes()['state']);
    }

    public function testGetTownsByLgaId()
    {
        $towns = $this->optionsService->getTownsByLgaId(self::LGA_ID);
        $this->assertTrue(is_array($towns));
        $this->assertGreaterThan(0, count($towns));
        $this->assertEquals(self::LGA_ID, $towns[0]->getAttributes()['lga_id']);
    }

    public function testGetTownsByLgaName()
    {
        $towns = $this->optionsService->getTownsByLgaName(self::LGA);
        $this->assertTrue(is_array($towns));
        $this->assertGreaterThan(0, count($towns));
        $this->assertEquals(self::LGA, $towns[0]->getAttributes()['lga']);
    }

    public function testGetOlevelGrades()
    {
        $grades = $this->optionsService->getOlevelGrades();
        $this->assertTrue(is_array($grades));
        $this->assertGreaterThan(0, count($grades));
        $this->assertArrayHasKey('grade_name', $grades[0]->getAttributes());
    }

    public function testGetGenders()
    {
        $genders = $this->optionsService->getGenders();
        $this->assertTrue(is_array($genders));
        $this->assertGreaterThan(0, count($genders));
        $this->assertArrayHasKey('gender_name', $genders[0]->getAttributes());
    }

    public function testGetModes()
    {
        $modes = $this->optionsService->getModes();
        $this->assertTrue(is_array($modes));
        $this->assertGreaterThan(0, count($modes));
        $this->assertArrayHasKey('mode_name', $modes[0]->getAttributes());
    }

    public function testGetReligions()
    {
        $religions = $this->optionsService->getReligions();
        $this->assertTrue(is_array($religions));
        $this->assertGreaterThan(0, count($religions));
        $this->assertArrayHasKey('religion_name', $religions[0]->getAttributes());
    }

    public function testGetTitles()
    {
        $titles = $this->optionsService->getTitles();
        $this->assertTrue(is_array($titles));
        $this->assertGreaterThan(0, count($titles));
        $this->assertArrayHasKey('title', $titles[0]->getAttributes());
    }

    public function testGetSemesters()
    {
        $semesters = $this->optionsService->getSemesters();
        $this->assertTrue(is_array($semesters));
        $this->assertGreaterThan(0, count($semesters));
        $this->assertArrayHasKey('semester_name', $semesters[0]->getAttributes());
    }

    public function testGetQualifications()
    {
        $qualifications = $this->optionsService->getQualifications();
        $this->assertTrue(is_array($qualifications));
        $this->assertGreaterThan(0, count($qualifications));
        $this->assertArrayHasKey('qualf_name', $qualifications[0]->getAttributes());
    }

    public function testGetGlobalSettings()
    {
        $settings = $this->optionsService->getGlobalSettings();
        $this->assertTrue(is_array($settings));
        $this->assertGreaterThan(0, count($settings));
        $this->assertArrayHasKey('key_name', $settings[0]->getAttributes());
    }
}

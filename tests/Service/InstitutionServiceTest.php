<?php

namespace Tests\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\InstitutionService;
use Artisan;

class InstitutionServiceTest extends TestCase
{
  use RefreshDatabase;

  const INSTITUTION_ID = 1;
  const INSTITUTION_CODE = 'N225';
  const INSTITUTION_NAME = 'NWAFOR ORIZU COLLEGE OF EDUCTAION, NSUGBE';

  private $institutionService;

  public function setUp()
  {
    parent::setUp();
    if (!$this->institutionService) $this->institutionService = app()->make(InstitutionService::class);
    Artisan::call('db:seed');
  }

  public function testGetInstitutions()
  {
    $institutions = $this->institutionService->getInstitutions();
    $this->assertTrue(is_array($institutions));
    $this->assertGreaterThan(0, count($institutions));
  }

  public function testGetInstitionById()
  {
    $institution = $this->institutionService->getInstitutionById(self::INSTITUTION_ID);
    $institutionAttrs = $institution->getAttributes();
    $this->assertArrayHasKey('institution_name', $institutionAttrs);
    $this->assertEquals(self::INSTITUTION_ID, $institutionAttrs['id']);
  }

  public function testGetInstitutionByCode()
  {
    $institution = $this->institutionService->getInstitutionByCode(self::INSTITUTION_CODE);
    $institutionAttrs = $institution->getAttributes();
    $this->assertArrayHasKey('institution_code', $institutionAttrs);
    $this->assertEquals(self::INSTITUTION_CODE, $institutionAttrs['institution_code']);
  }

  public function testGetInstitutionByName()
  {
    $institution = $this->institutionService->getInstitutionByName(self::INSTITUTION_NAME);
    $institutionAttrs = $institution->getAttributes();
    $this->assertArrayHasKey('institution_name', $institutionAttrs);
    $this->assertEquals(self::INSTITUTION_NAME, $institutionAttrs['institution_name']);
  }
}

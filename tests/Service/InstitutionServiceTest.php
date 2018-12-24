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

  public function testGetAll()
  {
    $institutions = $this->institutionService->getAll();
    $this->assertTrue(is_array($institutions));
    $this->assertGreaterThan(0, count($institutions));
  }

  public function testGetInstitionById()
  {
    $institution = $this->institutionService->getById(self::INSTITUTION_ID);
    $institutionAttrs = $institution->getAttributes();
    $this->assertArrayHasKey('institution_name', $institutionAttrs);
    $this->assertEquals(self::INSTITUTION_ID, $institutionAttrs['id']);
  }

  public function testGetByCode()
  {
    $institution = $this->institutionService->getByCode(self::INSTITUTION_CODE);
    $institutionAttrs = $institution->getAttributes();
    $this->assertArrayHasKey('institution_code', $institutionAttrs);
    $this->assertEquals(self::INSTITUTION_CODE, $institutionAttrs['institution_code']);
  }

  public function testGetByName()
  {
    $institution = $this->institutionService->getByName(self::INSTITUTION_NAME);
    $institutionAttrs = $institution->getAttributes();
    $this->assertArrayHasKey('institution_name', $institutionAttrs);
    $this->assertEquals(self::INSTITUTION_NAME, $institutionAttrs['institution_name']);
  }
}

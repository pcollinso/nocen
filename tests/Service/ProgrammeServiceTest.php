<?php

namespace Tests\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\ProgrammeService;
use Artisan;

class ProgrammeServiceTest extends TestCase
{
  use RefreshDatabase;

  const PROGRAMME_ID = 1;
  const INSTITUTION_ID = 1;
  const PROGRAMME_NAME = 'DEGREE';

  private $programmeService;

  public function setUp()
  {
    parent::setUp();
    if (!$this->programmeService) $this->programmeService = app()->make(ProgrammeService::class);
    Artisan::call('db:seed');
  }

  public function testGetAll()
  {
    $programmes = $this->programmeService->getAll();
    $this->assertTrue(is_array($programmes));
    $this->assertGreaterThan(0, count($programmes));
  }

  public function testGetById()
  {
    $programme = $this->programmeService->getById(self::PROGRAMME_ID);
    $programmeAttrs = $programme->getAttributes();
    $this->assertArrayHasKey('programme_name', $programmeAttrs);
    $this->assertEquals(self::PROGRAMME_ID, $programmeAttrs['id']);
  }

  public function testGetByInstitutionAndName()
  {
    $programme = $this->programmeService->getByInstitutionAndName(self::INSTITUTION_ID, self::PROGRAMME_NAME);
    $programmeAttrs = $programme->getAttributes();
    $this->assertEquals(self::INSTITUTION_ID, $programmeAttrs['institution_id']);
    $this->assertEquals(self::PROGRAMME_NAME, $programmeAttrs['programme_name']);
  }
}

<?php

namespace Tests\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\GradeAService;
use Artisan;

class GradeAServiceTest extends TestCase
{
  use RefreshDatabase;

  const GRADE_A_ID = 1;
  const GRADE_A_NAME = 'A';

  private $gradeAService;

  private function getAttrs()
  {
    return [ 'grade_range' => 50, 'grade_name' => self::GRADE_A_NAME ];
  }

  public function setUp()
  {
    parent::setUp();
    if (!$this->gradeAService) $this->gradeAService = app()->make(GradeAService::class);
    Artisan::call('db:seed');
  }

  public function testGetAll()
  {
    $grades = $this->gradeAService->getAll();
    $this->assertTrue(is_array($grades));
    $this->assertGreaterThan(0, count($grades));
  }

  public function testGetById()
  {
    $grade = $this->gradeAService->getById(self::GRADE_A_ID);
    $gradeAttrs = $grade->getAttributes();
    $this->assertArrayHasKey('grade_name', $gradeAttrs);
    $this->assertEquals(self::GRADE_A_ID, $gradeAttrs['id']);
  }

  public function testGetByName()
  {
    $grade = $this->gradeAService->getByName(self::GRADE_A_NAME);
    $gradeAttrs = $grade->getAttributes();
    $this->assertEquals(self::GRADE_A_NAME, $gradeAttrs['grade_name']);
  }

  public function testCreate()
  {
    $attrs = $this->getAttrs();
    $attrs['grade_name'] = 'Z';
    $grade = $this->gradeAService->create($attrs);
    $gradeAttrs = $grade->getAttributes();
    $this->assertEquals($attrs['grade_name'], $gradeAttrs['grade_name']);
  }

  public function testCreateShouldReturnExistingIfGivenDuplicateName()
  {
    $grade = $this->gradeAService->create($this->getAttrs());
    $gradeAttrs = $grade->getAttributes();
    $this->assertEquals(self::GRADE_A_NAME, $gradeAttrs['grade_name']);
    $this->assertEquals(self::GRADE_A_ID, $gradeAttrs['id']);
  }
}

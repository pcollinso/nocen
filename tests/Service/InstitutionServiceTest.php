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
  const PROGRAMME_ID = 1;
  const FACULTY_ID = 1;
  const DEPARTMENT_ID = 2;
  const INSTITUTION_CODE = 'N225';
  const INSTITUTION_NAME = 'NWAFOR ORIZU COLLEGE OF EDUCTAION, NSUGBE';
  const PROGRAMME_NAME = 'DEGREE';
  const DEPARTMENT_NAME = 'AAB';

  private $institutionService;

  private function getAttrs()
  {
    return [
      'programme_id' => self::PROGRAMME_ID,
      'institution_id' => self::INSTITUTION_ID,
      'faculty_id' => self::FACULTY_ID,
      'department_name' => self::DEPARTMENT_NAME,
    ];
  }

  public function setUp()
  {
    parent::setUp();
    if (!$this->institutionService) $this->institutionService = app()->make(InstitutionService::class);
    Artisan::call('db:seed', ['--class' => 'InstitutionTypeTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'InstitutionTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'ProgrammeTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'FacultyTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'DepartmentTableSeeder']);
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

  public function testGetProgrammes()
  {
    $programmes = $this->institutionService->getProgrammes();
    $this->assertTrue(is_array($programmes));
    $this->assertGreaterThan(0, count($programmes));
  }

  public function testGetProgrammeById()
  {
    $programme = $this->institutionService->getProgrammeById(self::PROGRAMME_ID);
    $programmeAttrs = $programme->getAttributes();
    $this->assertArrayHasKey('programme_name', $programmeAttrs);
    $this->assertEquals(self::PROGRAMME_ID, $programmeAttrs['id']);
  }

  public function testGetProgrammeByInstitutionAndName()
  {
    $programme = $this->institutionService->getProgrammeByInstitutionAndName(self::INSTITUTION_ID, self::PROGRAMME_NAME);
    $programmeAttrs = $programme->getAttributes();
    $this->assertEquals(self::INSTITUTION_ID, $programmeAttrs['institution_id']);
    $this->assertEquals(self::PROGRAMME_NAME, $programmeAttrs['programme_name']);
  }

  public function testGetFaculties()
  {
    $faculties = $this->institutionService->getFaculties();
    $this->assertTrue(is_array($faculties));
    $this->assertGreaterThan(0, count($faculties));
  }

  public function testGetFacultiesByInstitution()
  {
    $faculties = $this->institutionService->getFacultiesByInstitution(self::INSTITUTION_ID);
    $this->assertTrue(is_array($faculties));
    $this->assertGreaterThan(0, count($faculties));
  }

  public function testGetFacultiesByProgramme()
  {
    $faculties = $this->institutionService->getFacultiesByProgramme(self::PROGRAMME_ID);
    $this->assertTrue(is_array($faculties));
    $this->assertGreaterThan(0, count($faculties));
  }

  public function testGetFacultyById()
  {
    $faculty = $this->institutionService->getFacultyById(self::FACULTY_ID);
    $facultyAttrs = $faculty->getAttributes();
    $this->assertArrayHasKey('faculty_name', $facultyAttrs);
    $this->assertEquals(self::FACULTY_ID, $facultyAttrs['id']);
  }

  public function testGetDepartments()
  {
    $depts = $this->institutionService->getDepartments();
    $this->assertTrue(is_array($depts));
    $this->assertGreaterThan(0, count($depts));
  }

  public function testGetDepartmentsByInstitution()
  {
    $depts = $this->institutionService->getDepartmentsByInstitution(self::INSTITUTION_ID);
    $this->assertTrue(is_array($depts));
    $this->assertGreaterThan(0, count($depts));
  }

  public function testGetDepartmentsByProgramme()
  {
    $depts = $this->institutionService->getDepartmentsByProgramme(self::PROGRAMME_ID);
    $this->assertTrue(is_array($depts));
    $this->assertGreaterThan(0, count($depts));
  }

  public function testGetDepartmentsByFaculty()
  {
    $depts = $this->institutionService->getDepartmentsByFaculty(self::FACULTY_ID);
    $this->assertTrue(is_array($depts));
    $this->assertGreaterThan(0, count($depts));
  }

  public function testGetDepartmentById()
  {
    $dept = $this->institutionService->getDepartmentById(self::DEPARTMENT_ID);
    $deptAttrs = $dept->getAttributes();
    $this->assertArrayHasKey('department_name', $deptAttrs);
    $this->assertEquals(self::DEPARTMENT_ID, $deptAttrs['id']);
  }

  public function testCreateDepartment()
  {
    $attrs = $this->getAttrs();
    $attrs['department_name'] = 'TEST DEPT';
    $dept = $this->institutionService->createDepartment($attrs);
    $deptAttrs = $dept->getAttributes();
    $this->assertEquals($dept['department_name'], $deptAttrs['department_name']);
  }

  public function testCreateDepartmentShouldReturnExistingIfGivenDuplicateValues()
  {
    $dept = $this->institutionService->createDepartment($this->getAttrs());
    $deptAttrs = $dept->getAttributes();
    $this->assertEquals(self::DEPARTMENT_ID, $deptAttrs['id']);
  }
}

<?php

namespace Tests\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\CourseService;
use Artisan;

class CourseServiceTest extends TestCase
{
  use RefreshDatabase;

  const LVL_ID = 1;
  const SEM_ID = 1;
  const COURSE_ID = 1;
  const INST_ID = 1;
  const FAC_ID = 1;
  const PROG_ID = 1;
  const DEPT_ID = 2;
  const GEN_COURSE_ID = 1;
  const STAFF_COURSE_ID = 4;
  const STAFF_ID = 7;
  const C_CODE = 'CS101';
  const C_NAME = 'INTRODUCTION TO COMPUTER';

  private $courseService;

  private function getAttrs()
  {
    return [
      'institution_id' => self::INST_ID,
      'faculty_id' => self::FAC_ID,
      'programme_id' => self::PROG_ID,
      'department_id' => self::DEPT_ID,
      'level_id' => self::LVL_ID,
      'semester_id' => self::SEM_ID,
      'course_name' => self::C_NAME,
      'course_code' => self::C_CODE
    ];
  }

  private function getPrerequisiteAttrs()
  {
    return [
      'institution_id' => self::INST_ID,
      'course_id' => self::COURSE_ID,
      'require_course_id' => 10
    ];
  }

  private function getGeneralCourseAttrs()
  {
    return [
      'institution_id' => self::INST_ID,
      'course_id' => 3,
      'department_id' => self::DEPT_ID,
      'level_id' => self::LVL_ID,
      'semester_id' => self::SEM_ID,
    ];
  }

  private function getStaffCourseAttrs()
  {
    return [
      'institution_id' => self::INST_ID,
      'course_id' => self::COURSE_ID,
      'staff_id' => self::STAFF_ID,
    ];
  }

  public function setUp()
  {
    parent::setUp();
    if (!$this->courseService) $this->courseService = app()->make(CourseService::class);
    Artisan::call('db:seed', ['--class' => 'RoleAndPermissionSeeder']);
    Artisan::call('db:seed', ['--class' => 'GenderTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'QualificationTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'InstitutionTypeTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'InstitutionTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'LevelTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'SemesterTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'ProgrammeTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'FacultyTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'DepartmentTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'CourseTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'GeneralCourseTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'StaffTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'StaffCourseTableSeeder']);
  }

  public function testGetAll()
  {
    $courses = $this->courseService->getAll();
    $this->assertTrue(is_array($courses));
    $this->assertGreaterThan(0, count($courses));
  }

  public function testGetById()
  {
    $course = $this->courseService->getById(self::COURSE_ID);
    $courseAttrs = $course->getAttributes();
    $this->assertArrayHasKey('course_name', $courseAttrs);
    $this->assertEquals(self::COURSE_ID, $courseAttrs['id']);
  }

  public function testGetByInstitution()
  {
    $courses = $this->courseService->getByInstitution(self::INST_ID);
    $this->assertGreaterThan(0, count($courses));
  }

  public function testGetByFaculty()
  {
    $courses = $this->courseService->getByFaculty(self::FAC_ID);
    $this->assertGreaterThan(0, count($courses));
  }

  public function testGetByProgramme()
  {
    $courses = $this->courseService->getByProgramme(self::PROG_ID);
    $this->assertGreaterThan(0, count($courses));
  }

  public function testGetByDepartment()
  {
    $courses = $this->courseService->getByDepartment(self::DEPT_ID);
    $this->assertGreaterThan(0, count($courses));
  }

  public function testCreate()
  {
    $attrs = $this->getAttrs();
    $attrs['course_name'] = 'TEST COURSE';
    $attrs['course_code'] = 'TEST101';
    $course = $this->courseService->create($attrs);
    $courseAttrs = $course->getAttributes();
    $this->assertEquals($attrs['course_name'], $courseAttrs['course_name']);
    $this->assertEquals($attrs['course_code'], $courseAttrs['course_code']);
  }

  public function testCreateReturnsExistingWhenGivenDuplicate()
  {
    $course = $this->courseService->create($this->getAttrs());
    $courseAttrs = $course->getAttributes();
    $this->assertEquals(self::COURSE_ID, $courseAttrs['id']);
  }

  public function testGetAllPrerequisites()
  {
    $courses = $this->courseService->getAllPrerequisites();
    $this->assertTrue(is_array($courses));
  }

  public function testCreatePrerequisite()
  {
    $prereq = $this->courseService->createPrerequisite($this->getPrerequisiteAttrs());
    $preAttrs = $prereq->getAttributes();
    $this->assertEquals(self::COURSE_ID, $preAttrs['course_id']);
    $this->assertEquals(self::INST_ID, $preAttrs['institution_id']);
  }

  public function testGetPrerequisiteById()
  {
    $prereq = $this->courseService->createPrerequisite($this->getPrerequisiteAttrs())->getAttributes();
    $pre = $this->courseService->getPrerequisiteById($prereq['id']);
    $preAttrs = $pre->getAttributes();
    $this->assertEquals(self::COURSE_ID, $preAttrs['course_id']);
  }

  public function testGetPrerequisitesByInstitution()
  {
    $pres = $this->courseService->getPrerequisitesByInstitution(self::INST_ID);
    $this->assertTrue(is_array($pres));
  }

  public function testGetAllGeneralCourses()
  {
    $courses = $this->courseService->getAllGeneralCourses();
    $this->assertTrue(is_array($courses));
    $this->assertGreaterThan(0, count($courses));
  }

  public function testGetGeneralCourseById()
  {
    $course = $this->courseService->getGeneralCourseById(self::GEN_COURSE_ID);
    $courseAttrs = $course->getAttributes();
    $this->assertEquals(3, $courseAttrs['course_id']);
  }

  public function testGetGeneralCoursesByInstitution()
  {
    $courses = $this->courseService->getGeneralCoursesByInstitution(self::INST_ID);
    $this->assertGreaterThan(0, count($courses));
  }

  public function testGetGeneralCoursesByDepartment()
  {
    $courses = $this->courseService->getGeneralCoursesByDepartment(self::DEPT_ID);
    $this->assertGreaterThan(0, count($courses));
  }

  public function testCreateGeneralCourse()
  {
    $attrs = $this->getGeneralCourseAttrs();
    $attrs['course_id'] = self::COURSE_ID;
    $course = $this->courseService->createGeneralCourse($attrs);
    $courseAttrs = $course->getAttributes();
    $this->assertEquals($attrs['course_id'], $courseAttrs['course_id']);
  }

  public function testCreateGeneralCourseReturnsExistingWhenGivenDuplicate()
  {
    $course = $this->courseService->createGeneralCourse($this->getGeneralCourseAttrs());
    $courseAttrs = $course->getAttributes();
    $this->assertEquals(self::GEN_COURSE_ID, $courseAttrs['id']);
  }

  public function testGetAllStaffCourses()
  {
    $courses = $this->courseService->getAllStaffCourses();
    $this->assertTrue(is_array($courses));
    $this->assertGreaterThan(0, count($courses));
  }

  public function testGetStaffCourseById()
  {
    $course = $this->courseService->getStaffCourseById(self::STAFF_COURSE_ID);
    $courseAttrs = $course->getAttributes();
    $this->assertEquals(self::COURSE_ID, $courseAttrs['course_id']);
  }

  public function testGetStaffCoursesByInstitution()
  {
    $courses = $this->courseService->getStaffCoursesByInstitution(self::INST_ID);
    $this->assertGreaterThan(0, count($courses));
  }

  public function testGetStaffCoursesByStaff()
  {
    $courses = $this->courseService->getStaffCoursesByStaff(self::STAFF_ID);
    $this->assertGreaterThan(0, count($courses));
  }

  public function testCreateStaffCourse()
  {
    $attrs = $this->getStaffCourseAttrs();
    $attrs['course_id'] = 3;
    $course = $this->courseService->createStaffCourse($attrs);
    $courseAttrs = $course->getAttributes();
    $this->assertEquals($attrs['course_id'], $courseAttrs['course_id']);
  }

  public function testCreateStaffCourseReturnsExistingWhenGivenDuplicate()
  {
    $course = $this->courseService->createGeneralCourse($this->getGeneralCourseAttrs());
    $courseAttrs = $course->getAttributes();
    $this->assertEquals(self::COURSE_ID, $courseAttrs['id']);
  }
}

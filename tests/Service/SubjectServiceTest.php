<?php

namespace Tests\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\SubjectService;
use Artisan;

class SubjectServiceTest extends TestCase
{
  use RefreshDatabase;

  const SUBJECT_ID = 1;
  const SUBJECT_NAME = 'BLANK';
  const SUBJECT_CODE = 'BLANK';

  private $subjectService;

  private function getAttrs()
  {
    return [ 'subject_name' => self::SUBJECT_NAME, 'subject_code' => self::SUBJECT_CODE ];
  }

  public function setUp()
  {
    parent::setUp();
    if (!$this->subjectService) $this->subjectService = app()->make(SubjectService::class);
    Artisan::call('db:seed', ['--class' => 'SubjectTableSeeder']);
  }

  public function testGetAll()
  {
    $subjects = $this->subjectService->getAll();
    $this->assertTrue(is_array($subjects));
    $this->assertGreaterThan(0, count($subjects));
  }

  public function testGetById()
  {
    $subject = $this->subjectService->getById(self::SUBJECT_ID);
    $subjectAttrs = $subject->getAttributes();
    $this->assertArrayHasKey('subject_name', $subjectAttrs);
    $this->assertArrayHasKey('subject_code', $subjectAttrs);
    $this->assertEquals(self::SUBJECT_ID, $subjectAttrs['id']);
  }

  public function testGetByName()
  {
    $subject = $this->subjectService->getByName(self::SUBJECT_NAME);
    $subjectAttrs = $subject->getAttributes();
    $this->assertEquals(self::SUBJECT_NAME, $subjectAttrs['subject_name']);
  }

  public function testGetByCode()
  {
    $subject = $this->subjectService->getByCode(self::SUBJECT_CODE);
    $subjectAttrs = $subject->getAttributes();
    $this->assertEquals(self::SUBJECT_CODE, $subjectAttrs['subject_code']);
  }

  public function testCreate()
  {
    $attrs = $this->getAttrs();
    $attrs['subject_code'] = 'CODE';
    $attrs['subject_name'] = 'CODE';
    $subject = $this->subjectService->create($attrs);
    $subjectAttrs = $subject->getAttributes();
    $this->assertEquals($attrs['subject_code'], $subjectAttrs['subject_code']);
    $this->assertEquals($attrs['subject_name'], $subjectAttrs['subject_name']);
  }

  public function testCreateShouldReturnExistingIfGivenDuplicateName()
  {
    $attrs = $this->getAttrs();
    $attrs['subject_code'] = 'CODE';
    $subject = $this->subjectService->create($attrs);
    $subjectAttrs = $subject->getAttributes();
    $this->assertEquals(self::SUBJECT_NAME, $subjectAttrs['subject_name']);
    $this->assertEquals(self::SUBJECT_ID, $subjectAttrs['id']);
  }

  public function testCreateShouldReturnExistingIfGivenDuplicateCode()
  {
    $attrs = $this->getAttrs();
    $attrs['subject_name'] = 'CODE';
    $subject = $this->subjectService->create($attrs);
    $subjectAttrs = $subject->getAttributes();
    $this->assertEquals(self::SUBJECT_CODE, $subjectAttrs['subject_code']);
    $this->assertEquals(self::SUBJECT_ID, $subjectAttrs['id']);
  }
}

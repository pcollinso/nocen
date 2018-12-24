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
    Artisan::call('db:seed');
  }

  public function testGetSubjects()
  {
    $subjects = $this->subjectService->getSubjects();
    $this->assertTrue(is_array($subjects));
    $this->assertGreaterThan(0, count($subjects));
  }

  public function testGetSubjectById()
  {
    $subject = $this->subjectService->getSubjectById(self::SUBJECT_ID);
    $subjectAttrs = $subject->getAttributes();
    $this->assertArrayHasKey('subject_name', $subjectAttrs);
    $this->assertArrayHasKey('subject_code', $subjectAttrs);
    $this->assertEquals(self::SUBJECT_ID, $subjectAttrs['id']);
  }

  public function testGetSubjectByName()
  {
    $subject = $this->subjectService->getSubjectByName(self::SUBJECT_NAME);
    $subjectAttrs = $subject->getAttributes();
    $this->assertEquals(self::SUBJECT_NAME, $subjectAttrs['subject_name']);
  }

  public function testGetSubjectByCode()
  {
    $subject = $this->subjectService->getSubjectByCode(self::SUBJECT_CODE);
    $subjectAttrs = $subject->getAttributes();
    $this->assertEquals(self::SUBJECT_CODE, $subjectAttrs['subject_code']);
  }

  public function testCreateSubject()
  {
    $attrs = $this->getAttrs();
    $attrs['subject_code'] = 'CODE';
    $attrs['subject_name'] = 'CODE';
    $subject = $this->subjectService->createSubject($attrs);
    $subjectAttrs = $subject->getAttributes();
    $this->assertEquals($attrs['subject_code'], $subjectAttrs['subject_code']);
    $this->assertEquals($attrs['subject_name'], $subjectAttrs['subject_name']);
  }

  public function testCreateSubjectShouldReturnExistingIfGivenDuplicateName()
  {
    $attrs = $this->getAttrs();
    $attrs['subject_code'] = 'CODE';
    $subject = $this->subjectService->createSubject($attrs);
    $subjectAttrs = $subject->getAttributes();
    $this->assertEquals(self::SUBJECT_NAME, $subjectAttrs['subject_name']);
    $this->assertEquals(self::SUBJECT_ID, $subjectAttrs['id']);
  }

  public function testCreateSubjectShouldReturnExistingIfGivenDuplicateCode()
  {
    $attrs = $this->getAttrs();
    $attrs['subject_name'] = 'CODE';
    $subject = $this->subjectService->createSubject($attrs);
    $subjectAttrs = $subject->getAttributes();
    $this->assertEquals(self::SUBJECT_CODE, $subjectAttrs['subject_code']);
    $this->assertEquals(self::SUBJECT_ID, $subjectAttrs['id']);
  }
}

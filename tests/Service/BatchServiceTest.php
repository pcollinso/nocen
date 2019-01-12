<?php

namespace Tests\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\BatchService;
use Artisan;

class BatchServiceTest extends TestCase
{
  use RefreshDatabase;

  const BATCH_ID = 1;
  const BATCH_YEAR = '2010';

  private $batchService;

  private function getAttrs()
  {
    return [ 'batch_year' => self::BATCH_YEAR, 'batch_name' => 'Something' ];
  }

  public function setUp()
  {
    parent::setUp();
    if (!$this->batchService) $this->batchService = app()->make(BatchService::class);
    Artisan::call('db:seed', ['--class' => 'BatchTableSeeder']);
  }

  public function testGetAll()
  {
    $batches = $this->batchService->getAll();
    $this->assertTrue(is_array($batches));
    $this->assertGreaterThan(0, count($batches));
  }

  public function testGetById()
  {
    $batch = $this->batchService->getById(self::BATCH_ID);
    $batchAttrs = $batch->getAttributes();
    $this->assertArrayHasKey('batch_name', $batchAttrs);
    $this->assertArrayHasKey('batch_year', $batchAttrs);
    $this->assertEquals(self::BATCH_ID, $batchAttrs['id']);
  }

  public function testGetByYear()
  {
    $batch = $this->batchService->getByYear(self::BATCH_YEAR);
    $batchAttrs = $batch->getAttributes();
    $this->assertArrayHasKey('batch_name', $batchAttrs);
    $this->assertArrayHasKey('batch_year', $batchAttrs);
    $this->assertEquals(self::BATCH_YEAR, $batchAttrs['batch_year']);
  }

  public function testCreate()
  {
    $attrs = $this->getAttrs();
    $attrs['batch_year'] = 2018;
    $attrs['batch_name'] = '2018/2019';
    $batch = $this->batchService->create($attrs);
    $batchAttrs = $batch->getAttributes();
    $this->assertEquals($attrs['batch_year'], $batchAttrs['batch_year']);
    $this->assertEquals($attrs['batch_name'], $batchAttrs['batch_name']);
  }

  public function testCreateShouldReturnExistingIfGivenDuplicateYear()
  {
    $batch = $this->batchService->create($this->getAttrs());
    $batchAttrs = $batch->getAttributes();
    $this->assertEquals(self::BATCH_YEAR, $batchAttrs['batch_year']);
    $this->assertEquals(self::BATCH_ID, $batchAttrs['id']);
  }
}

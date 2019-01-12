<?php

namespace Tests\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\ModuleService;
use Artisan;

class ModuleServiceTest extends TestCase
{
  use RefreshDatabase;

  const MODULE_ID = 1;
  const MODULE_NAME = 'MANAGEMENT';

  private $moduleService;

  private function getAttrs()
  {
    return [ 'is_service' => 0, 'module_name' => self::MODULE_NAME ];
  }

  public function setUp()
  {
    parent::setUp();
    if (!$this->moduleService) $this->moduleService = app()->make(ModuleService::class);
    Artisan::call('db:seed', ['--class' => 'ModuleTableSeeder']);
  }

  public function testGetAll()
  {
    $modules = $this->moduleService->getAll();
    $this->assertTrue(is_array($modules));
    $this->assertGreaterThan(0, count($modules));
  }

  public function testGetById()
  {
    $module = $this->moduleService->getById(self::MODULE_ID);
    $moduleAttrs = $module->getAttributes();
    $this->assertArrayHasKey('module_name', $moduleAttrs);
    $this->assertEquals(self::MODULE_ID, $moduleAttrs['id']);
  }

  public function testGetByName()
  {
    $module = $this->moduleService->getByName(self::MODULE_NAME);
    $moduleAttrs = $module->getAttributes();
    $this->assertArrayHasKey('module_name', $moduleAttrs);
    $this->assertEquals(self::MODULE_NAME, $moduleAttrs['module_name']);
  }

  public function testCreate()
  {
    $attrs = $this->getAttrs();
    $attrs['module_name'] = 'TEST MODULE';
    $module = $this->moduleService->create($attrs);
    $moduleAttrs = $module->getAttributes();
    $this->assertEquals($attrs['module_name'], $moduleAttrs['module_name']);
  }

  public function testCreateShouldReturnExistingIfGivenDuplicateName()
  {
    $module = $this->moduleService->create($this->getAttrs());
    $moduleAttrs = $module->getAttributes();
    $this->assertEquals(self::MODULE_NAME, $moduleAttrs['module_name']);
    $this->assertEquals(self::MODULE_ID, $moduleAttrs['id']);
  }
}

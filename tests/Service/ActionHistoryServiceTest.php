<?php

namespace Tests\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\ActionHistoryService;
use Artisan;

class ActionHistoryServiceTest extends TestCase
{
  use RefreshDatabase;

  private $actionHistoryService;

  private function getAttrs()
  {
    return [ 'institution_id' => 1, 'user_id' => 1, 'name' => 'Name', 'action' => 'Something' ];
  }

  public function setUp()
  {
    parent::setUp();
    if (!$this->actionHistoryService) $this->actionHistoryService = app()->make(ActionHistoryService::class);
  }

  public function testGetAll()
  {
    $history = $this->actionHistoryService->getAll();
    $this->assertTrue(is_array($history));
  }

  public function testGetByUser()
  {
    $this->actionHistoryService->create($this->getAttrs());
    $history = $this->actionHistoryService->getByUser(1);
    $this->assertTrue(is_array($history));
    $this->assertEquals(1, count($history));
  }

  public function testCreate()
  {
    $attrs = $this->getAttrs();
    $history = $this->actionHistoryService->create($attrs);
    $historyAttrs = $history->getAttributes();
    $this->assertEquals($attrs['name'], $historyAttrs['name']);
    $this->assertEquals($attrs['action'], $historyAttrs['action']);
  }
}

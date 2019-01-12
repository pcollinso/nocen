<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Artisan;
use App\Providers\CustomUserProvider;
use App\Models\Permission;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
      parent::setUp();
      Artisan::call('db:seed', ['--class' => 'RoleAndPermissionSeeder']);
      Artisan::call('db:seed', ['--class' => 'UserTableSeeder']);
    }

    private function getUserProvider()
    {
        return app()->make(CustomUserProvider::class);
    }

    public function testHasPermission()
    {
        $superadmin = $this->getUserProvider()->retrieveById('support@appmartgroup.com');

        $this->assertTrue($superadmin->hasPermission('institution:create'));
        $this->assertFalse($superadmin->hasPermission('random:do'));
    }

    public function testHasRole()
    {
        $superadmin = $this->getUserProvider()->retrieveById('support@appmartgroup.com');

        $this->assertTrue($superadmin->hasRole('superadmin'));
        $this->assertFalse($superadmin->hasRole('random-role'));
    }
}

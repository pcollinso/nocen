<?php

namespace Tests\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Artisan;
use Auth;
use App\Providers\CustomUserProvider;

class AuthTest extends TestCase
{
  use RefreshDatabase;

  public function setUp()
  {
    parent::setUp();
    Artisan::call('db:seed');
  }

  private function getCredentials($type) {
    if ($type === 'user') {
      return ['login' => 'support@appmartgroup.com', 'password' => 'Children12@'];
    }

    if ($type === 'staff') {
      return ['login' => 'N225229892', 'password' => 'Children12@'];
    }
  }

  private function getUserProvider() {
    return app()->make(CustomUserProvider::class);
  }

  public function testSuccessfulUserAuthentication()
  {
    $correct_credentials = $this->getCredentials('user');

    $this->assertCredentials($correct_credentials);
    $this->assertTrue(Auth::attempt($correct_credentials));
    $this->assertAuthenticated();

    Auth::logout();
    $this->assertGuest();
  }

  public function testUnsuccessfulUserAuthentication()
  {
    $wrong_credentials =  $this->getCredentials('user');
    $wrong_credentials['password'] = 'Children';

    $this->assertInvalidCredentials($wrong_credentials);
    $this->assertFalse(Auth::attempt($wrong_credentials));
    $this->assertGuest();
  }

  public function testSuccessfulStaffAuthentication()
  {
    $correct_credentials = $this->getCredentials('staff');

    $this->assertCredentials($correct_credentials);
    $this->assertTrue(Auth::attempt($correct_credentials));
    $this->assertAuthenticated();

    Auth::logout();
    $this->assertGuest();
  }

  public function testUnsuccessfulStaffAuthentication()
  {
    $wrong_credentials =  $this->getCredentials('staff');
    $wrong_credentials['password'] = 'Children';

    $this->assertInvalidCredentials($wrong_credentials);
    $this->assertFalse(Auth::attempt($wrong_credentials));
    $this->assertGuest();
  }

  public function testUserRetrievalById()
  {
    $provider = $this->getUserProvider();
    $user = $provider->retrieveById('support@appmartgroup.com');
    $this->assertEquals($user->email, 'support@appmartgroup.com');
    $this->assertNull($provider->retrieveById(10000000));
  }

  public function testStaffRetrievalById()
  {
    $user = $this->getUserProvider()->retrieveById('N225229892');
    $this->assertEquals($user->staff_email, 'pcollinso@yahoo.com');
  }
}

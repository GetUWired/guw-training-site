<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

     public function testUserMayViewHomePage()
    {
        $response = $this->get('/');

        $response->assertSee('Training Site');
        $response->assertStatus(200);
    }

    public function testUserCanLogin()
    {
        $user = factory(\App\User::class)->create([
            'password' => bcrypt('test1234')
        ]);

        $response = $this->call('POST', '/login', [
            'email' => $user->email,
            'password' => 'test1234',
            '_token' => csrf_token()
        ]);

        $response->assertRedirect('/home')
            ->assertStatus(302);
    }

    public function testUnauthenticatedUserMayNotSeeHome()
    {
        $response = $this->get('/home');

        $response->assertRedirect('/login');
    }

    public function testUnAuthenticatedUserMayNotSeeALanguageTemplate()
    {
        $response = $this->get('/problems/php');

        $response->assertRedirect('/login');
    }
}

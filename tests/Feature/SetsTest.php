<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SetsTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthenticatedUserMayViewSetsPage()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)
            ->get('/sets');

        $response->assertSee('Problem Sets')
            ->assertViewHas('sets');
    }

    public function testAuthenticatedUserMayViewSingleSet()
    {
        $user = factory(\App\User::class)->create();

        $set = factory(\App\Problem::class, 25)->create()->each(function($u) {factory(\App\Hint::class, 2)->create([
            'problem_id' => $u->id
        ]);});

        $pSet = factory(\App\Set::class, 5)->create()->each(function($k) {factory(\App\ProblemSet::class, 1)->create([
            'set_id' => $k->id,
            'problem_id' => \App\Problem::inRandomOrder()->pluck('id')->first()
        ]);});

        $set = \App\Set::first();
        $response = $this->actingAs($user)
            ->get('/sets/' . $set->id);

        $response->assertSee('Problem Set')
            ->assertViewHas('set');
    }
    
    public function testAdminUserMayViewCreateSet()
    {
        $user = factory(\App\User::class)->create([
            'user_level' => 10
        ]);
        
        $response = $this->actingAs($user)
            ->get('/sets/create');
        
        $response->assertSee('Add Problem Set');
    }
    
    public function testNonAdminUserMayNotViewCreateSet()
    {
        $user = factory(\App\User::class)->create([
            'user_level' => 0
        ]);
        
        $response = $this->actingAs($user)
            ->get('/sets/create');
        
        $response->assertRedirect('/home')
            ->assertSessionHas('message', 'You are not allowed to view that resource.');
    }
}

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

        $set = factory(\App\Problem::class, 50)->create()->each(function($u) {factory(\App\Hint::class, 2)->create();});

        $pSet = factory(\App\Set::class, 5)->create()->each(function($k) {factory(\App\ProblemSet::class, 5)->create(['set_id' => $k->id]);});

        $response = $this->actingAs($user)
            ->get('/sets/' . 1);

        $response->assertSee('Problem Set')
            ->assertViewHas('set');
    }
}

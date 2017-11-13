<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PointsTest extends TestCase
{
    use RefreshDatabase;

    public function testAUserCanHavePoints()
    {
        $user = factory(\App\User::class)->create();

        //Create problems and complete problems
        $problems = factory(\App\Problem::class, 10)->create();
        $user->problems()->toggle($problems);
        $this->assertGreaterThan(0, $user->problems->sum('points'));
    }

    public function testAnyUserCanSeeLeaderboard()
    {
        $response = $this->get('/leaderboard');
        $response->assertSee('Leaderboard');
    }
}

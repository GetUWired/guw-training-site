<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HintsTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_hints_display_on_problems()
    {
        $user = factory(\App\User::class)->create([
            'user_level' => 0,
        ]);
        $problem = factory(\App\Problem::class)->create();
        $hint = factory(\App\Hint::class)->create([
            'problem_id' => $problem,
            'hint'       => 'This is a hint',
        ]);
        $response = $this->actingAs($user)->get('/problems/all');
        $response->assertSee('This is a hint');
    }
}

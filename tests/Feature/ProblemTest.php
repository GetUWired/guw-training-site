<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProblemTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthenticatedUserMayViewProblems()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)
            ->get('/problems/php');

        $response->assertSee('No results were found.');
    }

    public function testUnauthenticatedUserMayNotViewProblems()
    {
        $response = $this->get('/problems/php');

        $response->assertRedirect('login');
    }

    public function testSuperAdminCanViewAddProblemPage()
    {
        $user = factory(\App\User::class)->create([
            'password' => bcrypt('test1234'),
            'user_level' => 10
        ]);

        $response = $this->actingAs($user)
            ->get('/add-problem');

        $response->assertSee('Add Problem');
    }

    public function testSuperAdminCanAddProblem()
    {
        $user = factory(\App\User::class)->create([
            'password' => bcrypt('test1234'),
            'user_level' => 10
        ]);

        $response = $this->actingAs($user)
            ->call('POST', '/save-problem',
                [
                    'problem' => 'A test question',
                    'type' => 'php',
                    'points' => 20,
                    'hint' => ['First Hint'],
                    '_token' => csrf_token()
                ]);

        $response->assertSessionHas('message', 'Problem Created!');
    }

    /**
     * No Problem being passed through to the save call
     */
    public function testSuperAdminAddProblemFailed()
    {
        $user = factory(\App\User::class)->create([
            'password' => bcrypt('test1234'),
            'user_level' => 10
        ]);

        $response = $this->actingAs($user)
            ->call('POST', '/save-problem',
                [
                    'type' => 'php',
                    'points' => 20,
                    'hint' => ['First Hint'],
                    '_token' => csrf_token()
                ]);

        $response->assertSessionHas('message', 'Something went wrong adding the problem.');
    }

    public function testNonSuperAdminMayNotAddProblem()
    {
        $user = factory(\App\User::class)->create([
            'password' => bcrypt('test1234'),
            'user_level' => 1
        ]);

        $response = $this->actingAs($user)
            ->call('POST', '/save-problem',
                [
                    'problem' => 'A test question',
                    'type' => 'php',
                    'points' => 20,
                    'hint' => ['First Hint'],
                    '_token' => csrf_token()
                ]);

        $response->assertRedirect('/home')
            ->assertSessionHas('message', 'You are not allowed to view that resource.');
    }

    public function testUserSeeProblemPageWhenNoProblemsCompleted()
    {
        $user = factory(\App\User::class)->create([
            'user_level' => 1
        ]);

        $problems = factory(\App\Problem::class, 10)->create();

        $response = $this->actingAs($user)
            ->get('/problems/php');

        $response->assertSee('Question');
    }

    public function testProblemPageHasVariables()
    {
        $user = factory(\App\User::class)->create([
            'user_level' => 1
        ]);

        $response = $this->actingAs($user)
            ->get('/problems/php');

        $response->assertViewHasAll(['problemList', 'problemRelations']);
    }

    public function testAuthenticatedUserCanViewSingleProblemPage()
    {
        $user = factory(\App\User::class)->create([
            'user_level' => 1
        ]);

        $problems = factory(\App\Problem::class, 10)->create();

        $response = $this->actingAs($user)
            ->get('/problem/1');

        $response->assertViewHas('problem');
    }
}

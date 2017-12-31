<?php

use Faker\Generator as Faker;

$autoIncrement = autoIncrement();

$factory->define(App\ProblemSet::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();

    return [
        'problem_id' => $autoIncrement->current(),
        'order' => $faker->numberBetween(1, 25),
        'set_id' => $faker->numberBetween(1, 10)
    ];
});

//Tinker Commands
//$set = factory(\App\Problem::class, 50)->create()->each(function($u) {factory(\App\Hint::class, 2)->create();});
// $pSet = factory(\App\Set::class, 5)->create()->each(function($k) {factory(\App\ProblemSet::class, 5)->create(['set_id' => $k->id]);});
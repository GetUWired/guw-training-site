<?php

use Faker\Generator as Faker;

$autoIncrement = autoIncrement();

$factory->define(App\UserProblem::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();

    return [
        'user_id' => $faker->numberBetween(1, 10),
        'problem_id' => $autoIncrement->current(),
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Hint::class, function (Faker $faker) {
    return [
        'problem_id' => $faker->numberBetween(1, 50),
        'hint' => $faker->paragraph(3),
    ];
});

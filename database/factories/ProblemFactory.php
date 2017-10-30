<?php

use Faker\Generator as Faker;

$factory->define(App\Problem::class, function (Faker $faker) {
    return [
        'question' => $faker->sentence(10),
        'type' => $faker->randomElement(['jquery', 'php']),
        'points' => $faker->numberBetween(1, 100),
    ];
});

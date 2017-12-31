<?php

use Faker\Generator as Faker;

$factory->define(App\Set::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(10),
    ];
});
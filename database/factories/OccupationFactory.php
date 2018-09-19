<?php

use Faker\Generator as Faker;

$factory->define(App\Occupation::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});

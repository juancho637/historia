<?php

use Faker\Generator as Faker;

$factory->define(App\Species::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});

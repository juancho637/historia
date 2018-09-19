<?php

use Faker\Generator as Faker;

$factory->define(App\State::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});

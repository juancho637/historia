<?php

use App\Species;
use Faker\Generator as Faker;

$factory->define(App\Breed::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'species_id' => Species::all()->random()->id,
    ];
});

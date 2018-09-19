<?php

use App\Breed;
use App\Client;
use Faker\Generator as Faker;

$factory->define(App\Pet::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'weight' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 50),
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => $faker->randomElement(['M', 'F']),
        'reproductive_status' => $faker->randomElement(['CASTRADO', 'REPRODUCTIVO']),
        'date_death' => null,
        'description_death' => null,
        'breed_id' => Breed::all()->random()->id,
    ];
});

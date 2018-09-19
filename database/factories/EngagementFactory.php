<?php

use App\Pet;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Engagement::class, function (Faker $faker) {
    return [
        'user_id' => User::ofOccupations([2, 3, 5])->get()->random()->id,
        'pet_id' => Pet::all()->random()->id,
        'date' => $faker->date($format = 'Y-m-d', $min = 'now'),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'home_service' => $faker->boolean,
        'reason' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});

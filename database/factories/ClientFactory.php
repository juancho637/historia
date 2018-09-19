<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'type_identification' => $faker->randomElement(['CC', 'CE', 'TI']),
        'identification' => $faker->numberBetween($min = 0, $max = 2000000000),
        'full_name' => $faker->firstName.' '.$faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'cell_phone' => $faker->tollFreePhoneNumber,
        'phone' => $faker->tollFreePhoneNumber,
        'address' => $faker->address,
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => $faker->randomElement(['M', 'F']),
        'smoker' => $faker->boolean,
        'junkie' => $faker->boolean,
    ];
});

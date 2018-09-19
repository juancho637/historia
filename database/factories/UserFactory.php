<?php

use App\Occupation;
use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $identification = $faker->numberBetween($min = 0, $max = 2000000000);
    $name = $faker->firstName;
    $last_name = $faker->lastName;

    return [
        'identification' => $identification,
        'name' => $name,
        'last_name' => $last_name,
        'full_name' => $name.' '.$last_name,
        'professional_identification' => $faker->numberBetween($min = 0, $max = 9999),
        'address' => $faker->address,
        'cell_phone' => $faker->tollFreePhoneNumber,
        'phone' => $faker->tollFreePhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt($identification),
        'occupation_id' => Occupation::where('id', '!=', 1)->get()->random()->id,
        'remember_token' => str_random(10),
    ];
});

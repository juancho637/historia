<?php

use App\Category;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'value' => $faker->numberBetween($min = 0, $max = 1000000),
        'tax_percentage' => 19.0,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'type' => $faker->randomElement(['producto', 'servicio']),
        'category_id' => Category::where('abbreviation', '<>', 'consultation')->get()->random()->id
    ];
});

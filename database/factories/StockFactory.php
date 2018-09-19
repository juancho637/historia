<?php

use App\Product;
use Faker\Generator as Faker;

$factory->define(App\Stock::class, function (Faker $faker) {
    $stock = $faker->numberBetween($min = 5, $max = 100);
    $product = Product::all()->random();
    return [
        'purchase_amount' => $stock,
        'stock_min' => 5,
        'stock' => $stock,
        'due_date' => $faker->dateTimeBetween($startDate = '+1 months', $endDate = '+5 years', $timezone = null),// $faker->date($format = 'Y-m-d', $max = 'now')
        'lot' => $faker->numberBetween($min = 1000, $max = 9999),
        'product_id' => $product->id,
        'provider_id' => $product->providers->random()->id,
    ];
});

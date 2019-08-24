<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement($array = array('NEW', 'REPO')),
        'brand' => $faker->randomElement(['Yamaha', 'Suzuki', 'Honda', 'Kawasaki', 'Kymco']),
        'model' => $faker->bothify('??###'),
        'color' => $faker->randomElement(['Red', 'Black', 'Blue']),
        'price' => $faker->numberBetween($min = 15000, $max = 70000),
        'downpayment' => $faker->numberBetween(500, 2000)
    ];
});

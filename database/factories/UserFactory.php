<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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
    return [
        'firstname' => $faker->firstName,
        'middlename' => $faker->firstName,
        'lastname' => $faker->lastName,
        'username' => 'admin',
        'password' => '$2y$10$s8fufLQhRKZt4nmjO/gQtOJSDkNwNSDWXnXk4t843Wdv0kImefYeW', // admin
        'remember_token' => Str::random(10)
    ];
});

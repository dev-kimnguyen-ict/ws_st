<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'password' => bcrypt('admin123'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'active' => true,
        'blocked' => false,
        'role_id' => User::USER,
    ];
});

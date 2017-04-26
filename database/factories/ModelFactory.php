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
$factory->define(\App\Models\User::class, function (\Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'password' => bcrypt('secret'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'active' => true,
        'blocked' => false,
        'role_id' => \App\Models\User::USER,
    ];
});

$factory->define(\App\Models\Category::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'active' => true,
    ];
});

$factory->define(\App\Models\Seo::class, function (\Faker\Generator $faker) {
    $slug = str_slug(strtolower($faker->unique()->sentence));

    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'alias' => $slug,
    ];
});

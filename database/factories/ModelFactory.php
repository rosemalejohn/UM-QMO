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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'position' => 'User',
        'department_id' => null,
        'id_number' => $faker->barcode,
        'type' => 'staff',
        'gender' => $faker->gender,
        'photo_url' => $faker->imageUrl,
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->text,
    ];
});


$factory->define(App\Department::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->text,
        'code' => $faker->word,
    ];
});

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


$factory->define(App\Models\RequestForm::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'college' =>$faker->text,
        'school_year' => $faker->year,
        'contact_number' => $faker->e164PhoneNumber,
        'request_for' => $faker->text,
        'is_done' => rand(0,1)
    ];
});

$factory->define(App\Models\Memo::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->text,
        'body' => $faker->paragraph,
        'user_id' => rand(1,2)
    ];
});

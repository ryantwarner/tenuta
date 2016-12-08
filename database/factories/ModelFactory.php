<?php

use Faker\Generator;
use App\Models\Access\User\User;
use App\Models\Location;
use App\Models\Unit;

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

$factory->define(User::class, function (Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Location::class, function(Generator $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->streetAddress,
//        'province' => $faker->
        'postal_code' => $faker->postcode,
        'country' => $faker->country,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude
    ];
});

$factory->define(Unit::class, function(Generator $faker) {
    return [
        'price' => $faker->numberBetween(300, 1400),
    ];
});
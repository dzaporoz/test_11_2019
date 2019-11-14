<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Client;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name'                  => $faker->name,
        'surname'               => $faker->lastName,
        'email'                 => $faker->unique()->safeEmail,
        'date-of-birth'         => $faker->date(),
        'address'               => str_replace(array("\n","\r"), '', $faker->address),
        'phone-number'          => rand(100,999) . '-' . rand(100,999) . '-' .rand(1000, 9999),
        'country'               => $faker->country,
        'trading-account-number'=> rand(1000000, 9999999),
        'balance'               => rand(0, 100000) . '.' . rand(0, 99),
        'open-trades'           => rand(0, 100),
        'close-trades'          => rand(0,1000),
        'password'              => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token'        => Str::random(10),
    ];
});

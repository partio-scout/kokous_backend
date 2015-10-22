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

use Carbon\Carbon;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'partio_id' => $faker->unique()->regexify('[A-Z0-9]{10,10}'),
        'membernumber' => $faker->unique()->regexify('[A-Z0-9]{10,10}'),
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Activity::class, function (Faker\Generator $faker) {
    $agegroups = ['sudenpennut', 'samoajat', 'tarpojat', 'seikkailijat', 'vaeltajat'];
    return [
        'guid' => $faker->unique()->randomNumber,
        'name' => 'Activity ' . $faker->unique()->randomNumber,
        'age_group' => $faker->randomElement($agegroups)
    ];
});

$factory->define(App\Group::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Group ' . $faker->unique()->randomNumber,
        'scout_group' => $faker->company,
        'age_group' => 'Age group ' . $faker->randomNumber
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {
    $time = Carbon::instance($faker->dateTimeBetween(Carbon::now()->subMonths(6), Carbon::now()->addYear()));
    
    return [
        'name' => 'Event ' . $faker->unique()->randomNumber,
        'description' => $faker->word,
        'time' => $time,
        'place' => $faker->word,
        'endDate' =>$faker->dateTimeBetween($time,$time->copy()->addYear())
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->unique()->username,
        'partio_id' => $faker->unique()->randomNumber,
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'membernumber' => $faker->unique()->randomNumber,
        'postalcode' => '00550',
        'is_scout' => true,
        'email' => $faker->email

    ];
});

$factory->defineAs(App\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'username' => 'admin',
        'partio_id' => '55000',
        'firstname' => 'admin',
        'lastname' => 'admin',
        'membernumber' => '1000',
        'postalcode' => '00550',
        'is_scout' => true,
        'email' => 'admin@admin.fi'

    ];
});

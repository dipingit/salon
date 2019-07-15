<?php

use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'name'		=> $faker->name,
        'mobile'	=> $faker->phoneNumber,
        'email'	=> $faker->email,
        'gender'	=> 'Male',
        'age'	=> $faker->numberBetween(20,35),
        'address'	=> $faker->address
    ];
});

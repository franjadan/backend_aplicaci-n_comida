<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'favourite_order_name' => $faker->word, 
        'guest_name' => $faker->name, 
        'guest_address' => $faker->address, 
        'guest_phone' => $faker->phoneNumber, 
        'estimated_time' => $faker->time($format = 'H:i:s', $max = 'now'), 
        'real_time' => $faker->dateTime, 
        'comment' => $faker->sentence,
        'paid' => false,
        'state' => $faker->randomElement(['pending', 'finished', 'cancelled']),
        'total' => $faker->randomNumber()
    ];
});

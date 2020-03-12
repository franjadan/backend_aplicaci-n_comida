<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'favourite_order_name' => $faker->word, 
        'guest_name' => $faker->name, 
        'guest_address' => $faker->address, 
        'guest_phone' => $faker->phoneNumber, 
        'order_date' => $faker->dateTime, 
        'estimated_time' => $faker->dateTime, 
        'real_time' => $faker->dateTime, 
        'comment' => $faker->sentence,
        'paid' => false,
        'state' => 'pending',
    ];
});

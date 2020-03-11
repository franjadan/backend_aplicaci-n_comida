<?php

use Faker\Generator as Faker;

$faker = Faker::create('es_ES');

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'favourite_order_name' => $faker->word, 
        'guest_name' => $faker->name, 
        'guest_adress' => $faker->address, 
        'guest_phone' => $faker->phoneNumber, 
        'order_date' => $faker->dateTime, 
        'estimated_time' => $faker->dateTime, 
        'real_time' => $faker->dateTime, 
        'comment' => $faker->sentence,
        'paid' => false,
        'state' => 'pending',
        'user_id' => '1',
    ];
});

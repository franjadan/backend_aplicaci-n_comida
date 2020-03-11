<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'favourite_order_name' => $faker->word, 
        'guest_name' => $faker->name, 
        'guest_adress' => $faker->address, 
        'guest_phone' => $faker->phone_number, 
        'order_date' => $faker->date_time, 
        'estimated_time' => $faker->date_time, 
        'real_time' => $faker->date_time, 
        'comment' => $faker->sentence
    ];
});

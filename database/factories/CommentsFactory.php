<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->paragraph
    ];
});


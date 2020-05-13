<?php

use Faker\Generator as Faker;

$factory->define(App\Allergen::class, function (Faker $faker) {
    return [
        'image' => 'media/shared/min/imagen_defecto.png',
        'name' => $faker->word
    ];
});

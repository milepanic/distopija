<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'category_id' => $faker->numberBetween($min = 1, $max = 15),
        'user_id' => $faker->numberBetween($min = 1, $max = 16),
    ];
});

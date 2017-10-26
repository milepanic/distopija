<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'nsfw' => $faker->numberBetween($min = 0, $max = 1),
        'cover_box' => $faker->numberBetween($min = 0, $max = 1),
        'pictures' => $faker->numberBetween($min = 0, $max = 1),
        'videos' => $faker->numberBetween($min = 0, $max = 1),
    ];
});

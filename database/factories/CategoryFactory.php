<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->lastName,
        'nsfw' => $faker->boolean,
        'cover_box' => $faker->boolean,
        'pictures' => $faker->boolean,
        'videos' => $faker->boolean,
        'mods_only' => $faker->boolean,
    ];
});

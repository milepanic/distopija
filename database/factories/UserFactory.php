<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'slug' => function (array $user) {
        	return str_slug($user['name']);
        },
        'description' => $faker->paragraph,
        'remember_token' => str_random(10),
    ];
});

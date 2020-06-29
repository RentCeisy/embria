<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\News::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->paragraph(10, true)
    ];
});

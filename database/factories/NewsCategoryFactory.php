<?php

use Faker\Generator as Faker;

$factory->define(App\NewsCategory::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'desc' => $faker->sentence,
    ];
});

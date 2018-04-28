<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'desc' => $faker->sentence,
        'text' => $faker->text,
        'cat_id' => function (array $post) {
            return App\NewsCategory::find(rand(1,10))->id;
        }
    ];
});

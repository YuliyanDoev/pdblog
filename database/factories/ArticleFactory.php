<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(300),
        'image' => '/images/articles/2019/10/25/info.png',
        'category_id' => rand(1,4),
        'user_id'=>rand(2,5)
    ];
});

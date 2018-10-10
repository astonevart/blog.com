<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'content' => $faker->text($maxNbChars = 200),
        'image' => 'photo1.png',
        'date' => '2018-10-02',
        'views' => $faker->numberBetween($min = 0, $max = 5000),
        'status' => 1,
        'category_id' => $faker->numberBetween($min = 1, $max = 5),
        'user_id' => 1,
        'is_featured' => 0
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(Delivery\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomFloat(2, 10, 50),
        'image' =>$faker->imageUrl(640,480,'food',true,'Faker')
    ];
});

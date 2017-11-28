<?php

use Faker\Generator as Faker;

$factory->define(Delivery\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'company_id' => $faker->numberBetween(1, 5),
        'image' =>$faker->imageUrl(640,480,'food',true,'Faker')
    ];
});

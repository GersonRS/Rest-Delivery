<?php

use Faker\Generator as Faker;

$factory->define(Delivery\Models\OrderItem::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween(1, 5),
        'amount' => $faker->randomDigitNotNull,
        'price' => $faker->randomFloat(2, 50, 250),
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(Delivery\Models\Order::class, function (Faker $faker) {
    return [
        'client_id' => $faker->numberBetween(1, 10),
        'company_id' => $faker->numberBetween(1, 5),
        'total' => $faker->randomFloat(2, 50, 250),
        'status' => 0
    ];
});

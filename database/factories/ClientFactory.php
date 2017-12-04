<?php

use Faker\Generator as Faker;

$factory->define(Delivery\Models\Client::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => $faker->postcode
    ];
});

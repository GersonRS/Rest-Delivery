<?php

use Faker\Generator as Faker;

$factory->define(Delivery\Models\Client::class, function (Faker $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => $faker->postcode,
        'image' =>$faker->imageUrl(640,480,'people',true,'Faker')
    ];
});

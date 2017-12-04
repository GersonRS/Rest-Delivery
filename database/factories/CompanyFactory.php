<?php

use Faker\Generator as Faker;

$factory->define(Delivery\Models\Company::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'name' => $faker->company,
        'name_label' => $faker->companySuffix,
        'lat' => $faker->randomFloat(6, -72, -34),
        'lng' => $faker->randomFloat(6, -32, 4),
        'website' => $faker->domainName,
        'mail' => $faker->companyEmail,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'image' =>$faker->imageUrl(640,480,'business',true,'Faker'),
        'active' => $faker->boolean(100)
    ];
});

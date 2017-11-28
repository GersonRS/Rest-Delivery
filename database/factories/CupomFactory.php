<?php

use Faker\Generator as Faker;

$factory->define(Delivery\Models\Cupom::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(6),
        'value' => $faker->randomFloat(2, 50, 250),
        'type'   => $faker->randomElement($array = array ('percent','value'))
    ];
});

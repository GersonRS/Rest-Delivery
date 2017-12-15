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

$factory->define(Delivery\Models\Photo::class, function (Faker $faker) {
    return [
        'url' =>$faker->imageUrl(640,480,'people',true,'Faker'),
        'company_id' => $faker->numberBetween(1, 5)
    ];
});

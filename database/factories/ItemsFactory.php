<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Items;
use Faker\Generator as Faker;

$factory->define(Items::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomFloat($nbMaxDecimals = 2,$min=0,$max=20),
        'stock' => $faker->numberBetween($min=1, $max=1000)
    ];
});

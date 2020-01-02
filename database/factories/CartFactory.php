<?php

use App\Models\Cart;

$factory->define(Cart::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(100, 10000),
    ];
});

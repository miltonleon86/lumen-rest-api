<?php

use App\Models\Item;

$factory->define(Item::class, function (Faker\Generator $faker) {
	return [
		'name'     => $faker->name,
		'status'   => $faker->boolean(50),
		'quantity' => $faker->numberBetween(1, 1000),
	];
});




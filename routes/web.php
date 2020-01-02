<?php

use Laravel\Lumen\Routing\Router;

$router->group([
	'prefix'     => '/',
	'middleware' => ['my-theresa'],
], function (Router $router) {

	$router->get('/cart/get-items', [
		'uses' => 'CartManagerController@getItemsFromCart',
	]);

	$router->post('/cart/add-item', [
		'uses' => 'CartManagerController@addItemToCart',
	]);
});

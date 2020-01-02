<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CartManagerControllerTest extends TestCase
{

	/** The Database will be truncated after tests execution */
	use DatabaseMigrations;

	/** @var string */
	const GET_URI = '/cart/get-items';

	/** @var string */
	const POST_URI = '/cart/add-item';

	/**
	 * Api Test Needs Migrations and Seeds.
	 */
	public function setUp(): void
	{
		parent::setUp();
		$this->artisan('db:seed');
	}

	/** Group Asserts Parameter Exceptions */

	public function testGetItemsFromCartIdNotProvided()
	{
		$this->json('GET', static::GET_URI)->seeJson(
			["id" => ["The id field is required."]]
		);
	}

	public function testGetItemsFromCartIdHasToBeInteger()
	{
		$this->json('GET', static::GET_URI . '?id=abc')->seeJson(
			["id" => ["The id must be an integer."]]
		);
	}

	public function testGetItemsFromCartWhenCartIdDoesNotExist()
	{
		$this->json('GET', static::GET_URI . '?id=999')->seeJson(
			["id" => ["The selected id is invalid."]]
		);
	}

	public function testAddItemsToCartWhenInvalidParameters()
	{
		/** Add Item to Cart */
		$this->json('POST', static::POST_URI,
			[
				"cartId" => 100, "itemId" => 1
			])->seeJson(
			["cartId" => ["The selected cart id is invalid."]]
		);

		/** Add Item to Cart */
		$this->json('POST', static::POST_URI,
			[
				"cartId" => 1, "itemId" => 100
			])->seeJson(
			["itemId" => ["The selected item id is invalid."]]
		);
	}

	public function testAddItemsToCartWhenNotInteger()
	{
		/** Add Item to Cart */
		$this->json('POST', static::POST_URI,
			[
				"cartId" => 1, "itemId" => 'abc'
			]
		)->seeJson(
			["itemId" => ["The item id must be an integer."]]
		);

		/** Add Item to Cart */
		$this->json('POST', static::POST_URI,
			[
				"cartId" => 'abc', "itemId" => 1
			]
		)->seeJson(
			["cartId" => ["The cart id must be an integer."]]
		);
	}

	public function testAddItemsToCartEmptyJsonRequest()
	{
		/** Add Item to Cart */
		$this->json('POST', static::POST_URI, ["itemId" => 1])->seeJson(
			["cartId" => ["The cart id field is required."]]
		);

		/** Add Item to Cart */
		$this->json('POST', static::POST_URI, ["cartId" => 1])->seeJson(
			["itemId" => ["The item id field is required."]]
		);
	}

	/** END */

	/** Assert Success */

	public function testGetItemsFromCartIdCartExistButNoItemsRelated()
	{
		$this->json('GET', static::GET_URI . '?id=1')->seeJson(
			["id" => 1]
		);
	}

	public function testGetItemsFromCartIdSuccessAndAddItemToCartApi()
	{
		$itemIdToAdd = 1;
		$cartId = 1;

		$array = ["cartId" => $cartId, "itemId" => $itemIdToAdd];

		/** Add Item to Cart */
		$this->json('POST', static::POST_URI, $array)->seeJson(
			$array
		);

		$this->json('GET', static::GET_URI . '?id=1')->seeJson(
			[
				"id" => $cartId,
				"itemId" => $itemIdToAdd,
			]
		);
	}

	/** END */

}

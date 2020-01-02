<?php

use App\Models\Cart;
use App\Models\Item;
use App\Repositories\CartRepository;
use App\Repositories\ItemCartRepository;
use App\Services\CartManagerService;

/**
 * Class CartManagerServiceTest
 */
class CartManagerServiceTest extends TestCase
{
	public function testGetCartAndItems()
	{
		$response = [
			'id'     => 123,
			'userId' => 123,
			'items'  => [[
				"itemId" => 123,
				"name"   => "name",
				"status" => 1,
			]],
		];

		$service = new CartManagerService(
			$this->mockCartManagerRepository($this->mockCartRepository()),
			$this->mockItemCartRepository()
		);

		$results = $service->getCartAndItems(123);

		$this->assertEquals($response, $results);
	}

	public function testAddItemToCart()
	{
		$request = ['itemId' => 123, 'cartId' => 123];

		$cart = new Cart();

		$service = new CartManagerService(
			$this->mockCartManagerRepository($cart),
			$this->mockItemCartRepository()
		);

		$results = $service->addItemToCart($request);

		$this->assertEquals($request, $results);
	}

	/**
	 * @param $desiredResponse
	 *
	 * @return \App\Repositories\CartRepository
	 */
	private function mockCartManagerRepository($desiredResponse): CartRepository
	{
		$mock = $this->getMockBuilder(CartRepository::class)
			->disableOriginalConstructor()
			->setMethods(['find'])
			->getMock();

		$mock->method('find')->willReturn($desiredResponse);

		return $mock;
	}

	/**
	 * @return \App\Repositories\ItemCartRepository
	 */
	private function mockItemCartRepository(): ItemCartRepository
	{
		$mock = $this->getMockBuilder(ItemCartRepository::class)
			->disableOriginalConstructor()
			->setMethods(['addItemToCart'])
			->getMock();

		$mock->method('addItemToCart')->willReturn(null);

		return $mock;
	}

	/**
	 * @return \App\Repositories\CartRepository
	 */
	private function mockCartRepository(): CartRepository
	{
		$item         = new Item();
		$item->id     = 123;
		$item->name   = 'name';
		$item->status = 1;

		$mock = $this->getMockBuilder(CartRepository::class)
			->disableOriginalConstructor()
			->setMethods(['find', 'items', 'getId', 'getUserId'])
			->getMock();


		$mockCart = $this->getMockBuilder(Cart::class)
			->disableOriginalConstructor()
			->setMethods(['items', 'getId', 'getUserId'])
			->getMock();

		$mockItem = $this->getMockBuilder(Item::class)
			->disableOriginalConstructor()
			->setMethods(['get'])
			->getMock();

		$mockItem->method('get')->willReturn(
			[
				$item,
			]
		);

		$mock->method('items')->willReturn($mockItem);
		$mock->method('getId')->willReturn(123);
		$mock->method('getUserId')->willReturn(123);

		$mock->method('find')->willReturn($mockCart);

		return $mock;
	}
}

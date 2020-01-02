<?php


namespace App\Services;


use App\Repositories\CartRepository;
use App\Repositories\ItemCartRepository;

class CartManagerService
{
	/** @var CartRepository $cartRepository */
	private $cartRepository;

	/** @var ItemCartRepository $itemCartRepository */
	private $itemCartRepository;

	/**
	 * CartManagerService constructor.
	 *
	 * @param \App\Repositories\CartRepository     $cartRepository
	 * @param \App\Repositories\ItemCartRepository $itemCartRepository
	 */
	public function __construct(
		CartRepository $cartRepository,
		ItemCartRepository $itemCartRepository
	)
	{
		$this->cartRepository = $cartRepository;
		$this->itemCartRepository    = $itemCartRepository;
	}

	/**
	 * @param int $cartId
	 *
	 * @return array
	 */
	public function getCartAndItems(int $cartId): array
	{
		/** @var \App\Models\Cart $cart */
		$cart = $this->cartRepository->find($cartId);

		$response = [
			'id'     => $cart->getId(),
			'userId' => $cart->getUserId(),
		];

		foreach ($cart->items()->get() as $item) {
			$response['items'][] =
				[
					'itemId' => $item->id,
					'name'   => $item->name,
					'status' => $item->status,
				];
		}

		return $response;
	}

	public function addItemToCart(array $params): array 
	{
		$this->itemCartRepository->addItemToCart(
			$params['itemId'],
			$params['cartId']
		);

		return $params;
	}
}
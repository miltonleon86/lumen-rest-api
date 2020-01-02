<?php


namespace App\Repositories;


use App\Interfaces\RepositoryInterface;
use App\Models\ItemsCart;

class ItemCartRepository implements RepositoryInterface
{

	public function find(int $id)
	{
		// TODO: Implement find() method.
	}

	/**
	 * @param $itemId
	 * @param $cartId
	 */
	public function addItemToCart($itemId, $cartId): void
	{
		$itemCartModel = new ItemsCart();
		$itemCartModel->item_id = $itemId;
		$itemCartModel->cart_id = $cartId;

		$itemCartModel->save();
	}
}
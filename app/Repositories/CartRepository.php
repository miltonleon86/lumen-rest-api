<?php


namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Cart;

/**
 * Class CartRepository
 *
 * @package App\Repositories
 */
class CartRepository implements RepositoryInterface
{
	/** @var Cart $cartModel */
	private $cartModel;

	/**
	 * CartRepository constructor.
	 *
	 * @param \App\Models\Cart $cartModel
	 */
	public function __construct(Cart $cartModel)
	{
		$this->cartModel = $cartModel;
	}

	public function find(int $cartId)
	{
		return $this->cartModel->find($cartId);
	}
}
<?php


namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Item;

/**
 * Class ItemRepository
 *
 * @package App\Repositories
 */
class ItemRepository implements RepositoryInterface
{
	/** @var Item $itemModel */
	private $itemModel;

	/**
	 * ItemRepository constructor.
	 *
	 * @param \App\Models\Item $itemModel
	 */
	public function __construct(Item $itemModel)
	{
		$this->itemModel = $itemModel;
	}

	/**
	 * @param int $itemId
	 *
	 * @return \App\Models\Item
	 */
	public function find(int $itemId): Item
	{
		return $this->itemModel->find($itemId);
	}
}
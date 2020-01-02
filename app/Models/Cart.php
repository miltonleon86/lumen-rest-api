<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 *
 * @package App\Models
 */
class Cart extends Model
{
	/**
	 * This is just an idea about what an Cart could have.
	 * I imagine that a cart is bounded with a user in a one to one relation.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id'
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $hidden = [
		'',
	];

	public function getId()
	{
		return $this->id;
	}

	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * Many to Many with cart.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function items()
	{
		return $this->belongsToMany(Item::class, 'items_carts', 'cart_id', 'item_id');
	}
}
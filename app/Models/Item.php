<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @package App\Models
 */
class Item extends Model
{
	/**
	 * This is just an idea about what an Item could have.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'status',
		'quantity',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $hidden = [
		'',
	];

	/**
	 * Many to Many with cart.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function carts()
	{
		return $this->belongsToMany(Cart::class, 'items_carts', 'item_id', 'cart_id');
	}
}
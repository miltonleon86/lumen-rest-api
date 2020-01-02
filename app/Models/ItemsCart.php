<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemsCart
 *
 * @package App\Models
 */
class ItemsCart extends Model
{
	/**
	 * Extra table to represent cart and item relation
	 *
	 * @var array
	 */
	protected $fillable = [
		'cart_id',
		'item_id',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $hidden = [
		'',
	];
}
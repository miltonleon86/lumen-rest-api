<?php

namespace App\Http\Controllers;

use App\Services\CartManagerService;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Http\ResponseFactory;

/**
 * @OA\Schema(
 * 	schema="ItemCartSchema",
 * 	title="Item Cart Model",
 * 	description="Item Cart model",
 * 	@OA\Property(
 * 		property="itemId", description="An Item could be added to one or several carts",
 * 		@OA\Schema(type="integer", format="int64")
 *	),
 * 	@OA\Property(
 * 		property="cartId", description="A cart contains one or several items",
 * 		@OA\Schema(type="integer", format="int64")
 *	)
 * )
 */
class CartManagerController extends Controller
{
	/** @var CartManagerService $cartManagerService */
	private $cartManagerService;

    public function __construct(CartManagerService $cartManagerService)
    {
        $this->cartManagerService = $cartManagerService;
    }

	/**
	 * @param Request $request
	 *
	 * @return ResponseFactory
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 *
	 * @OA\Get(
	 *    path="/cart/get-items",
	 *    summary="Return the list of items from a cart",
	 *    tags={"Cart Item Manager"},
	 *
	 * @OA\Parameter(
	 * 	parameter="id",
	 * 	name="id",
	 * 	description="Represents the ID of a Cart",
	 * 	in="query",
	 *  required=true,
	 * 	@OA\Schema(
	 * 		type="integer", format="int64"
	 * 	)
	 * ),
	 *
	 * @OA\Response(
	 *        response=200,
	 *        description="Items list",
	 *    @OA\MediaType(
	 *      mediaType="application/json",
	 *        @OA\Schema(
	 *          example={"id": 1, "userId": 2,"items":{{"itemId": 10, "name": "name1", "status": 1},{"itemId": 11, "name": "name2", "status": 1}}}
	 *        )
	 *    )
	 *    )
	 * )
	 */
	public function getItemsFromCart(Request $request)
	{
		$this->validate($request, [
			'id' => 'required | integer | exists:carts',
		]);

		$response = $this->cartManagerService->getCartAndItems(
			$request->get('id')
		);

		return response($response);
	}

	/**
	 * @param Request $request
	 *
	 * @return ResponseFactory
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 * @OA\Post(
	 *    path="/cart/add-item",
	 *    summary="Add item to a cart",
	 *    tags={"Cart Item Manager"},
	 *
	 *  @OA\RequestBody(
	 *    @OA\MediaType(
	 *      mediaType="application/json",
	 *          @OA\Schema(
	 *              example={"cartId": 1, "itemId": 1}
	 *          )
	 *         )
	 *     ),
	 *
	 *  @OA\Response(
	 *        response=200,
	 *        description="Add item to a cart",
	 *    @OA\MediaType(
	 *      mediaType="application/json",
	 *        @OA\Schema(
	 *          example={"cartId": 1, "itemId": 1}
	 *        )
	 *    )
	 *    ),
	 * )
	 */
	public function addItemToCart(Request $request)
    {
	    $this->validate($request, [
		    'cartId' => 'required | integer | exists:carts,id',
		    'itemId' => 'required | integer | exists:items,id',
	    ]);

	    $response = $this->cartManagerService->addItemToCart($request->post());

	    return response($response);
    }
}

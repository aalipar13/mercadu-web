<?php namespace App\Api\Cart\Controllers;

use App\Api\Cart\Requests\CartRequest;
use App\Api\Cart\Services\CartService;

use Resource\Controllers\ResourceController;
use Resource\Repositories\ResourceRepository;
use Resource\Services\ResourceService;

use App\Base\BaseRequest;


class CartController extends ResourceController
{
    /**
     * @return ResourceService
     */
    protected function service()
    {
        return new CartService();
    }

    /**
     * Retrieve cart resource
     *
     * @return \Dingo\Api\Http\Response
     */
    public function showCart($userId)
    {
        #check if user has cart
        return $this->success($this->service()->showCart($userId));
    }

    /**
     * Save cart
     *
     * @param CartRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function storeCart(CartRequest $request, $userId)
    {
        $params = $request->only('product_id');

        return $this->success($this->service()->storeCart($params, $userId));
    }

    /**
     * Remove item from cart
     *
     * @param CartRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function destroyCart(CartRequest $request)
    {
        $params = $request->only('product_id');

        return $this->success($this->service()->destroyCart($params));
    }
}
<?php

namespace App\Api\Cart\Services;

use Resource\Services\ResourceService;

use App\Api\Cart\Exceptions\CartException;

use App\Api\CartDetail\Services\CartDetailService;

use App\Api\Cart\Repositories\CartRepository;

use App\Modules\ArkCommerce\Product\Services\ProductService;

use Auth;


class CartService extends ResourceService
{
    /**
     * @return CartRepository
     */
    public function repository()
    {
        return new CartRepository();
    }

    /**
     * @return CartDetailService
     */
    public function cartDetailService()
    {
        return new CartDetailService();
    }

    /**
     * @return ProductService
     */
    public function productService()
    {
        return new ProductService();
    }

    /**
     * Get cart by user id
     *
     * @param $userId
     * @return mixed
     */
    public function getCartByUserId($userId)
    {
        return $this->repository->findBy('user_id', $userId);
    }

    /**
     * Retrieve cart resource
     *
     * @return array
     */
    public function showCart()
    {
        #check if user has cart
        $userId = Auth::guard('api')->id();

        $userCart = $this->repository()->fetchCartWithDetails($userId);

        if(!$userCart) {
            $userCartData = [
                             'user_id' => $userId
                            ];

            $userCart = $this->create($userCartData);
        }

        return $userCart;
    }

    /**
     * Save cart
     *
     * @param $params
     * @return array
     */
    public function storeCart($params)
    {
        #check if user has cart
        $userCart = $this->showCart();

        #see if item is still rented out
        $product = $this->productService()->getById($params['product_id']);

        // if($productVariation['status'] != 'available' || $productVariation['is_active'] != 'yes') {
        //     throw new CartException(CartException::ITEM_UNAVAILABLE);
        // }

        #see if item already in cart
        $cartDetail = $this->cartDetailService()->getCartDetailsByProductIdAndCartId($params['product_id'], $userCart['id']);

        // if($cartDetail) {
        //     throw new CartException(CartException::ITEM_IN_CART);
        // }

        try {
            $params['product_id'] = $product['id'];
            $params['cart_id'] = $userCart['id'];

            // if($params['insured'] === null) {
            //     unset($params['insured']);
            // }

            $item = $this->cartDetailService()->create($params);

        } catch (Exception $e) {
            throw new CartException(CartException::UNABLE_TO_ADD);
        }

        $result = $this->repository()->fetchCartByUserId($userCart['user_id']);

        $result->load('details');

        return $result->toArray();
    }

    /**
     * Remove item from cart
     *
     * @param CartRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function destroyCart($params)
    {
        #check if user has cart
        $userId = Auth::guard('api')->id();

        $userCart = $this->showCart();

        if(!$userCart) {
            throw new CartException(CartException::EMPTY_CART);
        }

        $userCartDetail = $this->cartDetailService()->getCartDetailsByProductIdAndCartId($params['product_id'], $userCart['id']);

        if(!$userCartDetail) {
            throw new CartException(CartException::NOT_IN_CART);
        }

        if($this->cartDetailService()->delete($userCartDetail['id'])) {
            $result = $this->repository()->fetchCartByUserId($userCart['user_id']);

            $result->load('details');

            return $result->toArray();
        }
        else
        {
            throw new CartException(CartException::UNKNOWN_ERROR);
        }
    }
}

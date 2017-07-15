<?php

namespace App\Api\CartDetail\Services;

use Resource\Services\ResourceService;

use App\Api\CartDetail\Repositories\CartDetailRepository;


/**
 * Class CartDetailService
 * @package App\Api\CartDetail\Services
 */
class CartDetailService extends ResourceService
{
    public function repository()
    {
        return new CartDetailRepository();
    }

    /**
     * Get cart details by cart id
     *
     * @param $cartId
     * @return mixed
     */
    public function getCartDetailsByCartId($cartId)
    {
        return $this->repository()->findByAttribute('cart_id', $cartId);
    }

    /**
     * Get Cart Detail By Product Variation And Cart Id
     * 
     * @param  $productVariationId
     * @param  $cartId
     * @return array
     */
    public function getCartDetailsByProductIdAndCartId($productId, $cartId)
    {
        return $this->repository()->fetchCartDetailByProductIdAndCartId($productId, $cartId);
    }
}
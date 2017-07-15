<?php

namespace App\Api\CartDetail\Repositories;

use App\Common\Models\CartDetail;
use Resource\Repositories\ResourceRepository;

/**
 * Class CartDetailRepository
 * @package Envogue\Api\Cart\Repositories
 */
class CartDetailRepository extends ResourceRepository
{
    /**
     * @var CartDetail
     */
    protected $model;

    /**
     * @return Cart
     */
    public function model()
    {
        return CartDetail::class;
    }

    /**
     * Get Cart Detail By Product And Cart Id
     * 
     * @param  $productId
     * @param  $cartId
     * @return array
     */
    public function fetchCartDetailByProductIdAndCartId($productId, $cartId)
    {
        $result = $this->model->where('product_id', $productId)
                           ->where('cart_id', $cartId)
                           ->first();

        if (empty($result)) {
            return $result;
        }
        else {
            return $result->toArray();
        }
    }
}
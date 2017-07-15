<?php namespace App\Api\Cart\Repositories;

use App\Common\Models\Cart;

use Resource\Repositories\ResourceRepository;

class CartRepository extends ResourceRepository
{
    /**
     * @return Cart
     */
    public function model()
    {
        return Cart::class;
    }

    /**
     * Fetch cart by user id
     *
     * @param $userId
     * @return mixed
     */
    public function fetchCartByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->first();
    }

    /**
     * Fetch Cart With Details
     * 
     * @param  $userId
     * @return mixed
     */
    public function fetchCartWithDetails($userId)
    {
        return $this->model->where('user_id', $userId)->with('details')->first();
    }
}

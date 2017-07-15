<?php namespace App\Api\Order\Repositories;


use App\Common\Models\Order;

use Resource\Repositories\ResourceRepository;


class OrderRepository extends ResourceRepository
{
    /**
     * @return Order
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Fetch Order With OrderDetail
     * 
     * @param  $userId
     * @return mixed
     */
    public function fetchOrderWithDetails($orderId)
    {
        return $this->model->where('id', $order)->with('details')->first();
    }
}
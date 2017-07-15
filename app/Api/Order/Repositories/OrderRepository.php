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
     * Fetch Order With Details
     * @param  $orderId
     * @return mixed
     */
    public function fetchOrderWithDetails($orderId)
    {
    	return $this->model->where('id', $orderId)->with('details')->first();
    }
}
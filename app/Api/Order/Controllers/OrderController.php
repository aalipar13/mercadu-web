<?php namespace App\Api\Order\Controllers;


use App\Api\Order\Services\OrderService;

use Resource\Controllers\ResourceController;

use App\Base\BaseRequest;


class OrderController extends ResourceController
{
    /**
     * @return ResourceService
     */
    protected function service()
    {
        return new OrderService();
    }

    public function checkout($userId)
    {
        return $this->success($this->service()->checkout($userId));
    }
}
<?php namespace App\Modules\ArkCommerce\Order\Controllers;


use Resource\Controllers\ResourceController;

use App\Base\BaseRequest;

use App\Modules\ArkCommerce\Order\Services\OrderService;


class OrderController extends ResourceController
{
    /**
     * @return OrderService
     */
    public function service()
    {
        return new OrderService;
    }

    /**
     * Add the product to session
     * 
     * @param BaseRequest $request
     */
    public function add(BaseRequest $request)
    {
        $id = $request->only('id');

        return $this->service()->addToOrder($id);;
    }

    /**
     * Remove the product from session
     */
    public function remove(BaseRequest $request)
    {
        $uniqueId = $request->only('id');

        return $this->service()->removeFromOrder($uniqueId);
    }

    /**
     * Get Total for Order
     */
    public function getTotal()
    {
        return $this->service()->getTotalOfOrder();
    }

    /**
     * Increase the Quantiy of Orders
     */
    public function increaseQuantity(BaseRequest $request)
    {
        $data = $request->all();

        return $this->service()->increaseQuantity($data);
    }

    /**
     * Decrease the Quantiy of Orders
     */
    public function decreaseQuantity(BaseRequest $request)
    {
        $data = $request->all();

        return $this->service()->decreaseQuantity($data);
    }
}

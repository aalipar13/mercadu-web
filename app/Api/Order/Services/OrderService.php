<?php namespace App\Api\Order\Services;


use App\Api\Order\Repositories\OrderRepository;

use App\Api\Cart\Services\CartService;

use App\Api\OrderDetail\Services\OrderDetailService;

use App\Modules\ArkCommerce\Product\Services\ProductService;

use App\Api\UserDetail\Services\UserDetailService;

use Resource\Services\ResourceService;

use Auth;


class OrderService extends ResourceService
{
    /**
     * @return CartService
     */
    public function cartService()
    {
        return new CartService();
    }

    /**
     * @return ProductService
     */
    public function productService()
    {
        return new ProductService();
    }

    /**
     * @return OrderDetailService
     */
    public function orderDetailService()
    {
        return new OrderDetailService();
    }

     /**
     * @return UserDetailService
     */
    public function userDetailService()
    {
        return new UserDetailService();
    }



    public function checkout($userId)
    {
        $cartDetails = $this->cartService()->showCart();

        $orderDetailData = [];

        // $user = Auth::guard('api')->user()->toArray();
        // $userDetail = Auth::guard('api')->user()->userDetail->toArray();
        $userDetail = $this->userDetailService()->getByUserId($userId);

        $orderData = [
                        // 'customer_id' => $userDetail['user_id'],
                        'merchant_id' => 3,
                        'first_name' => $userDetail['first_name'],
                        'last_name' => $userDetail['last_name'],
                        'email' => $userDetail['email'],
                        'mobile' => $userDetail['mobile']
                     ];

        foreach ($cartDetails['details'] as $details) {
            $orderDetailData['product_id'] = $details['product_id'];

            $product = $this->productService()->getById($details['product_id']);
            $total[] = $product['regular_price'];
        }

        $total = array_sum($total);

        $orderData['total'] = $total;

        $orderResult = $this->create($userDetail);

        // for ($i=0; $i < count($orderDetailData); $i++) { 
        //     $this->orderDetailService()->create($orderDetailData[$i]);
        // }

        // return $this->repository()->fetchOrderWithDetails($orderResult['id']);

    }
}

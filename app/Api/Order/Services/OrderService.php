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
     * @return OrderRepository
     */
    public function repository()
    {
        return new OrderRepository();
    }

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
        $cartDetails = $this->cartService()->showCart($userId);

        $orderDetailData = [];
        $total = [];

        // $user = Auth::guard('api')->user()->toArray();
        // $userDetail = Auth::guard('api')->user()->userDetail->toArray();
        $$userDetail = $this->userDetailService()->getByUserId($userId);

        $orderData = [
            'customer_id' => $userDetail['user_id'],
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

        $orderResult = $this->repository->create($orderData);

        $orderDetailData['order_id'] = $orderResult['id'];

        for ($i=0; $i < count($orderDetailData); $i++) { 
            $this->orderDetailService()->create($orderDetailData);
        }

        $this->fundTransfer($userDetail['bank_account_number']);

        return $this->repository()->fetchOrderWithDetails($orderResult['id']);

    }

    public function fundTransfer($accountNo)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-uat.unionbankph.com/uhac/sandbox/transfers/initiate",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"channel_id\":\".str_random(20).\",\"transaction_id\":\".str_random(20).\",\"source_account\":\".$accountNo.\",\"source_currency\":\"PHP\",\"target_account\":\"101033520667\",\"target_currency\":\"PHP\",\"amount\":7}",
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "content-type: application/json",
            "x-ibm-client-id: REPLACE_THIS_KEY",
            "x-ibm-client-secret: REPLACE_THIS_KEY"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
    }
}

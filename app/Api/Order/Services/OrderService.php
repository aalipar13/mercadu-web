<?php namespace App\Api\Order\Services;


use App\Api\Order\Repositories\OrderRepository;

use App\Api\Cart\Services\CartService;

use App\Api\CartDetail\Services\CartDetailService;

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
        $userDetail = $this->userDetailService()->getByUserId($userId);

        $orderData = [
            'customer_id' => $userDetail['user_id'],
            'merchant_id' => 3,
            'first_name' => $userDetail['first_name'],
            'last_name' => $userDetail['last_name'],
            'email' => $userDetail['email'],
            'mobile' => $userDetail['mobile']
         ];


        foreach ($cartDetails['details'] as $key => $details) {
            $orderDetailData[$key]['product_id'] = $details['product_id'];

            $product = $this->productService()->getById($details['product_id']);
            $total[] = $product['regular_price'];
        }

        $total = array_sum($total);

        $orderData['total'] = $total;

        $orderResult = $this->repository->create($orderData);

        for ($i=0; $i < count($orderDetailData); $i++) {
            $orderDetailData[$i]['order_id'] = $orderResult['id'];
            $this->orderDetailService()->create($orderDetailData[$i]);
        }

        // delete cart details
        foreach ($cartDetails['details'] as $key => $details) {
            $this->cartDetailService()->delete($details['id']);
        }

        $this->fundTransfer($userDetail['bank_account_number'], $total);

        $this->userDetailService()->updateRewardPoints($userId, $total);

        $result = $this->repository()->fetchOrderWithDetails($orderResult['id']);

        $result['reward_points'] = $total * 0.05;

        return $result;

    }

    public function fundTransfer($accountNo, $total)
    {
        $curl = curl_init();

        $random1 = str_random(20);
        $random2 = str_random(20);

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-uat.unionbankph.com/uhac/sandbox/transfers/initiate",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"channel_id\":\".$random1.\",\"transaction_id\":\".$random2.\",\"source_account\":".$accountNo.",\"source_currency\":\"PHP\",\"target_account\":\"101033520667\",\"target_currency\":\"PHP\",\"amount\":".$total."}",
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "content-type: application/json",
            "x-ibm-client-id: 629b0fc0-f83c-4802-abd0-3ebc6bf11c19",
            "x-ibm-client-secret: G3gN3hW0hR2hR6yA1aK1uN7aG5pW5wJ1cM7aM1oP8iI6eM7wD5"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          // echo "cURL Error #:" . $err;
        } else {
          // echo $response;
        }
    }
}

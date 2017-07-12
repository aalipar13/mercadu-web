<?php namespace App\Modules\ArkCommerce\Order\Services;


use Resource\Services\ResourceService;

use App\Modules\ArkCommerce\Product\Services\ProductService;

use App\Modules\ArkCommerce\Store\Services\StoreService;

use Session;


class OrderService extends ResourceService
{
    /**
     * @return ProductService
     */
    public function productService()
    {
        return new ProductService;
    }

    /**
     * @return StoreService
     */
    public function storeService()
    {
        return new StoreService;
    }

    /**
     * Add the product to Order
     * 
     * @param $id
     */
    public function addToOrder($productId)
    {
        /**
         * ADD TO ORDER
         * 
         * 1. Check if store is in session
         * 2. If TRUE, append to store session
         * 3. If FALSE, create store and append product to store
         */

        $uniqId = str_random(15);

        $product = $this->productService()->findProductById($productId);

        $total = ($product['sale_price'] * $product['min_quantity']);
        $product['total'] = number_format($total, 2);
        $product['sale_price'] = number_format($product['sale_price'], 2);
        $product['regular_price'] = number_format($product['regular_price'], 2);
        $product['qty'] = $product['min_quantity'];

        // Check if the product exists in the order, update qty and total
        return $this->productExistsAddToOrder($product);

        return $product;
    }

    /**
     * Remove the product from Order
     */
    public function removeFromOrder($data)
    {
        /**
         * REMOVE PRODUCT
         *
         * 1. Get product id
         * 2. Get store id
         * 3. Check in session
         *     -- Using the store and product id forget the product
         * 4. Update the total
         */
        $product = $this->productService()->findProductById($data['id']);
        $session = session()->get('cart.'.$product['store']['name'].'.orders');

        foreach ($session as $key => $value) {
            if ($data['id'] == $value['id']) {
                Session::forget('cart.'.$product['store']['name'].'.orders.'.$key);
            }
        }
    }

    /**
     * Get Total of Store Cart
     */
    public function getTotalOfOrder()
    {
        // get store name from session
        $storeName = session()->get('store-name');
        $store = $this->storeService()->getStoreWithName($storeName);

        $session = session()->get('cart.'.$store['name'].'.orders');

        if (!empty($session)) {
            // Get the total price of product
            foreach ($session as $orders) {
                $price = str_replace(',', '', $orders['sale_price']);
                $total[] = $price * $orders['qty'];
            }

            $total = array_sum($total);

            // Update the total
            if (Session::has('cart.'.$store['name'].'.total')) {
                Session::forget('cart.'.$store['name'].'.total');
            }

            Session::push('cart.'.$store['name'].'.total', number_format($total, 2));
        }
        else {
            Session::forget('cart.'.$store['name'].'.total');
            $total = 0;
        }


        return number_format($total, 2);
    }

    /**
     * Increase the quantity of the orders
     */
    public function increaseQuantity($data)
    {
        $product = $this->productService()->findProductById($data['id']);

        $session = session()->get('cart.'.$product['store']['name'].'.orders');

        foreach ($session as $key => $value) {
            if ($data['id'] == $value['id']) {
                $value['qty'] = $value['qty'] + 1;
                
                $price = str_replace(',', '', $value['sale_price']);
                $total = number_format($price * $value['qty'], 2);
                $product['total'] = $total;

                Session::put('cart.'.$product['store']['name'].'.orders.'.$key.'.qty', $value['qty']);
                Session::put('cart.'.$product['store']['name'].'.orders.'.$key.'.total', $total);
            }
        }

        return $product;
    }

    /**
     * Increase the quantity of the product in order
     */
    public function productExistsAddToOrder($data)
    {
        /**
         * SAME PRODUCT ADD TO ORDER
         *
         * 1. Check if product id is in that store
         *     -- If not, push to store cart
         * 2. Update quantity to product (+1)
         * 3. Update the total
         * 4. Update session
         */
        $products = [];

        $session = !(empty(session()->get('cart.'.$data['store']['name'].'.orders'))) ? session()->get('cart.'.$data['store']['name'].'.orders') : [];

        foreach ($session as $order) {
            $products[] = $order['id'];
        }

        if (!(in_array($data['id'], $products)))
        {
            Session::push('cart.'.$data['store']['name'].'.orders', $data);
        }
        else
        {
            foreach ($session as $key => $value) {
                if ($data['id'] == $value['id']) {
                    $value['qty'] = $value['qty'] + $data['min_quantity'];

                    $price = str_replace(',', '', $value['sale_price']);
                    $total = number_format($price * $value['qty'], 2);
                    $data['total'] = $total;

                    Session::put('cart.'.$data['store']['name'].'.orders.'.$key.'.qty', $value['qty']);
                    Session::put('cart.'.$data['store']['name'].'.orders.'.$key.'.total', $total);
                }
            }
        }

        return $data;
    }

    /**
     * Decrease the quantity of the orders
     */
    public function decreaseQuantity($data)
    {
        $product = $this->productService()->findProductById($data['id']);

        $session = session()->get('cart.'.$product['store']['name'].'.orders');

        foreach ($session as $key => $value) {
            if ($data['id'] == $value['id']) {
                $value['qty'] = $value['qty'] - 1;

                $price = str_replace(',', '', $value['sale_price']);
                $total = number_format($price * $value['qty'], 2);
                $product['total'] = $total;

                Session::put('cart.'.$product['store']['name'].'.orders.'.$key.'.qty', $value['qty']);
                Session::put('cart.'.$product['store']['name'].'.orders.'.$key.'.total', $total);
            }
        }

        return $product;
    }
}
<?php namespace App\Api\Product\Controllers;

use App\Modules\ArkCommerce\Product\Requests\ProductRequest;
use App\Modules\ArkCommerce\Product\Services\ProductService;

use App\Modules\ArkCommerce\Store\Services\StoreService;

use Resource\Controllers\ResourceController;
use Resource\Repositories\ResourceRepository;
use Resource\Services\ResourceService;

use App\Base\BaseRequest;


class ProductController extends ResourceController
{
    /**
     * @return BaseRequest
     */
    protected function validation()
    {
        return new ProductRequest();
    }

    /**
     * @return ResourceService
     */
    protected function service()
    {
        return new ProductService();
    }

    /**
     * @return StoreService
     */
    protected function storeService()
    {
        return new StoreService();
    }

    /**
     * Retrieves all product data
     *
     * @param  BaseRequest $request
     * @return mixed
     */
    public function index(BaseRequest $request)
    {
        $records = $request->get('records');

        if (empty($records))
        {
            $result['productList'] = $this->service->getAllWithStore();
        }
        else
        {
            $products = $this->service->allProductsWithPagination($records);

            $result = $products['paginate'];
        }

        return $this->success($result);
    }

    /**
     * Retrieves all products for bidding
     *
     * @return mixed
     */
    public function getAllBiddingProducts()
    {
        return $this->success($this->service->getAllBiddingProducts());
    }
}

<?php namespace App\Modules\ArkCommerce\Product\Repositories;


use App\Common\Models\Product;

use Resource\Repositories\ResourceRepository;


class ProductRepository extends ResourceRepository
{
    /**
     * @return Product
     */
    public function model()
    {
        return Product::class;
    }

    /**
     * Find a product by id
     * @param  $id
     * @return mixed
     */
    public function findById($id){
        return $this->model->where('id', $id)
                           ->with('store')
                           ->first()
                           ->toArray();
    }

    /**
     * Retrieves all products for bidding
     *
     * @return mixed
     */
    public function getAllBiddingProducts()
    {
        return $this->model->where('type', 'bid')->get()->toArray();
    }

    /**
     * Get Product And Store by id
     *
     * @param  $id
     * @return mixed
     */
    public function getProductAndStore($id)
    {
        $products = $this->model
                    ->select(
                              'products.*',
                              'stores.name AS store_name'
                             )
                    ->leftjoin('stores AS stores', 'products.store_id', '=', 'stores.id')
                    ->where('products.id', '=', $id)
                    ->first()
                    ->toArray();

        return $products;
    }

    /**
     * Get All Categories And Store
     *
     * @return mixed
     */
    public function getAllProductAndStore()
    {
        $products =$this->model
                    ->select(
                              'products.*',
                              'stores.name AS store_name'
                             )
                    ->leftjoin('stores AS stores', 'products.store_id', '=', 'stores.id')
                    ->get()
                    ->toArray();

        return $products;
    }

    /**
     * Fetch Products using Store Id - dropdown list
     *
     * @param  $id
     * @return mixed
     */
    public function dropdownProductsByStoreId($storeId){
        return $this->model->where("store_id", $storeId)
                           ->pluck('name', 'id')
                           ->toArray();
    }
}

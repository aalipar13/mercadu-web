<?php namespace App\Modules\ArkCommerce\Store\Repositories;


use App\Common\Models\Store;

use Resource\Repositories\ResourceRepository;


class StoreRepository extends ResourceRepository
{
    /**
     * @return Store
     */
    public function model()
    {
        return Store::class;
    }

    /**
     * All Stores
     * 
     * @return mixed
     */
    public function allStores($records)
    {
    	return $this->model->paginate($records);
    }

    /**
     * Get store with store photos
     * 
     * @return mixed
     */
    public function getStoreWithStorePhotos($storeId)
    {
        return $this->model->where('id', $storeId)
                           ->with('storePhoto')
                           ->first()->toArray();
    }

    /**
     * Get store by name
     * 
     * @param  $name
     * @return mixed
     */
    public function getStoreByName($name)
    {
        return $this->model->where('name', 'LIKE', '%'.$name.'%')
                           ->first()
                           ->toArray();
    }
}
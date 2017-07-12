<?php namespace App\Modules\ArkCommerce\Category\Repositories;


use App\Common\Models\Category;

use Resource\Repositories\ResourceRepository;


class CategoryRepository extends ResourceRepository
{
    /**
     * @return Category
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Get Category And Store by id
     * 
     * @param  $id
     * @return mixed
     */
    public function getCategoryAndStore($id)
    {
        $categories = $this->model
                    ->select(
                              'categories.*',
                              'stores.name AS store_name'
                             )
                    ->leftjoin('stores AS stores', 'categories.store_id', '=', 'stores.id')
                    ->where('categories.id', '=', $id)
                    ->first()
                    ->toArray();

        return $categories;
    }

    /**
     * Get All Categories And Store
     * 
     * @return mixed
     */
    public function getAllCategoryAndStore()
    {
        $categories =$this->model
                    ->select(
                              'categories.*',
                              'stores.name AS store_name'
                             )
                    ->leftjoin('stores AS stores', 'categories.store_id', '=', 'stores.id')
                    ->get()
                    ->toArray();

        return $categories;
    }
}
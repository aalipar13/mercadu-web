<?php namespace App\Modules\ArkCommerce\Category\Services;


use App\Modules\ArkCommerce\Category\Repositories\CategoryRepository;

use App\Modules\ArkCommerce\Store\Services\StoreService;

use Resource\Services\ResourceService;

use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;


class CategoryService extends ResourceService
{
    /**
     * @return CategoryRepository
     */
    public function repository()
    {
        return new CategoryRepository();
    }

    /**
     * @return StoreService
     */
    public function storeService()
    {
        return new StoreService();
    }

    /**
     * Get All Tag With Store
     * 
     * @return mixed
     */
    public function getAllWithStore()
    {
        return $this->repository()->getAllCategoryAndStore();
    }

    /**
     * Get Tag With Store by id
     * 
     * @param  $id
     * @return mixed
     */
    public function getCategoryWithStore($id)
    {
        return $this->repository()->getCategoryAndStore($id);
    }

    /**
     * Get all categories with pagination
     * 
     * @param  $records
     * @return mixed
     */
    public function allCategoriesWithPagination($records)
    {
        $categories =  $this->repository->paginate($records);

        if(count($categories['data']) > 0)
        {
            //get the current route url
            $url = url(Route::getFacadeRoot()->current()->uri()) . '?records='.$records;

            //create the pagination manually
            $paginate = new LengthAwarePaginator($categories['data'], $categories['total'], $categories['per_page'], $categories['current_page'], array('path' => $url));

            // Get store and add in categories array
            foreach ($categories['data'] as $key => $category) {
                $store = $this->storeService()->getStoreName($category['store_id']);

                $categories['data'][$key]['store_name'] = $store['name'];
            }

            $categoryList = $categories['data'];
        }
        else
        {
            $categoryList = [];
            $paginate = [];
        }

        return [
                'categoryList' => $categoryList,
                'paginate' => $paginate
               ];
    }
}
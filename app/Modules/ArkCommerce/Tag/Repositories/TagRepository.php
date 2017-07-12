<?php namespace App\Modules\ArkCommerce\Tag\Repositories;


use App\Common\Models\Tag;

use Resource\Repositories\ResourceRepository;


class TagRepository extends ResourceRepository
{
    /**
     * @return Tag
     */
    public function model()
    {
        return Tag::class;
    }

    /**
     * Search tag using slug
     * 
     * @param  $slug
     * @return mixed
     */
    public function search($slug)
    {
        $results = $this->model->where("slug", "LIKE", '%'.$slug.'%')
            ->get();

        return $results;
    }

    /**
     * Fetch tag records by store_id
     * 
     * @param  $tagId
     * @return mixed
     */
    public function fetchTagsByStoreId($storeId)
    {
        $results = $this->model->where("store_id", $storeId)
            ->get()->toArray();

        return $results;
    }

    /**
     * Get Tag And Store by id
     * 
     * @param  $id
     * @return mixed
     */
    public function getTagAndStore($id)
    {
        $tags =$this->model
                    ->select(
                              'tags.*',
                              'stores.name AS store_name'
                             )
                    ->leftjoin('stores AS stores', 'tags.store_id', '=', 'stores.id')
                    ->where('tags.id', '=', $id)
                    ->first()
                    ->toArray();

        return $tags;
    }

    /**
     * Get All Tag And Store
     * 
     * @return mixed
     */
    public function getAllTagAndStore()
    {
        $tags =$this->model
                    ->select(
                              'tags.*',
                              'stores.name AS store_name'
                             )
                    ->leftjoin('stores AS stores', 'tags.store_id', '=', 'stores.id')
                    ->get()
                    ->toArray();

        return $tags;
    }

    /**
     * Fetch Tags using Store Id  - dropdown list
     * 
     * @param  $storeId
     * @return mixed
     */
    public function dropdownTagsByStoreId($storeId)
    {
        return $this->model->where("store_id", $storeId)
                           ->pluck('name', 'id')
                           ->toArray();
    }
}
<?php namespace App\Modules\ArkCommerce\TagMapping\Repositories;


use App\Common\Models\TagMapping;

use Resource\Repositories\ResourceRepository;

use Infrastructure\Criteria\WithRelationships;
use Infrastructure\Criteria\WhereAttributeConditionIs;


class TagMappingRepository extends ResourceRepository
{
    /**
     * @return TagMapping
     */
    public function model()
    {
        return TagMapping::class;
    }

    /**
     * Fetch tag mapping record by tag
     * 
     * @param  $tagId
     * @return mixed
     */
    public function fetchByTag($tagId)
    {
        $results = $this->model->where("tag_id", $tagId)
            ->get();

        return $results;
    }

    /**
     * Count tag mapping by store_id and tag_id
     */
    public function fetchByStoreAndTag($storeId, $tagId)
    {
        $results = $this->model->where('tag_id', $tagId)
                                ->where('store_id', $storeId)
                                ->get()->toArray();

        return $results;
    }

    /**
     * Find all tag mapping including all relationships
     *
     * @return array
     */
    public function allWithAllRelationships()
    {
        $this->pushCriteria(new WithRelationships('store'));
        $this->pushCriteria(new WithRelationships('tag'));
        $this->pushCriteria(new WithRelationships('product'));

        return $this->all();
    }

    /**
     * Find a tag mapping with all relationships
     * Get Products By Tags
     * 
     * @param  $id
     * @return mixed
     */
    public function tagMappingWithAllRelationships($id)
    {
        $tagMappings = $this->model
                    ->select(
                              'tag_mappings.*',
                              'stores.name AS store_name',
                              'tags.name AS tag_name',
                              'products.name AS product_name'
                             )
                    ->leftjoin('stores AS stores', 'tag_mappings.store_id', '=', 'stores.id')
                    ->leftjoin('tags AS tags', 'tag_mappings.tag_id', '=', 'tags.id')
                    ->leftjoin('products AS products', 'tag_mappings.product_id', '=', 'products.id')
                    ->where('tag_mappings.id', '=', $id)
                    ->first()
                    ->toArray();

        return $tagMappings;
    }

    /**
     * Get Products By Tags
     * 
     * @param  $id
     * @return mixed
     */
    public function getProductsByTags($id, $column)
    {
        // $this->pushCriteria(new WhereAttributeConditionIs($column, $id));
        // $this->pushCriteria(new WithRelationships('store', 'tag', 'product'));

        // return $this->all();
        $result = $this->model
                       ->select(
                                'stores.id as store_id',
                                'stores.name as store_name',
                                'stores.slug as store_slug',
                                'stores.description as store_description',
                                'stores.order_notice as store_order_notice',
                                'stores.store_img as store_img',
                                'stores.min_orders as store_min_orders',
                                'stores.delivery as store_delivery',
                                'stores.budget as store_budget',
                                // 'store_photos.id as store_photo_id',
                                // 'store_photos.photo as store_photo',
                                'tags.id as tag_id',
                                'tags.name as tag_name',
                                'tags.store_id as tag_store_id',
                                'tags.slug as tag_slug',
                                'tags.description as tag_description',
                                'products.id as product_id',
                                'products.name as product_name',
                                'products.description as product_description',
                                'products.sale_price as product_sale_price',
                                'products.photo as product_photo'
                        )
                       ->leftjoin('stores AS stores', 'stores.id', '=', 'tag_mappings.store_id')
                       // ->leftjoin('store_photos AS store_photos', 'store_photos.store_id', '=', 'tag_mappings.store_id')
                       ->leftjoin('tags AS tags', 'tags.id', '=', 'tag_mappings.tag_id')
                       ->leftjoin('products AS products', 'products.id', '=', 'tag_mappings.product_id')
                       ->where($column, '=', $id)
                       ->orderBy('products.name')
                       ->distinct()->get()
                       ->toArray();

        return $result;
    }
}
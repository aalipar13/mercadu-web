<?php namespace App\Modules\ArkCommerce\TagMapping\Services;


use App\Modules\ArkCommerce\TagMapping\Repositories\TagMappingRepository;

use App\Modules\ArkCommerce\Product\Repositories\ProductRepository;

use App\Modules\ArkCommerce\Tag\Repositories\TagRepository;

use Resource\Services\ResourceService;


class TagMappingService extends ResourceService
{
    /**
     * @return TagMappingRepository
     */
    public function repository()
    {
        return new TagMappingRepository();
    }

    /**
     * @return TagRepository
     */
    public function tagRepository()
    {
        return new TagRepository();
    }

    /**
     * @return ProductRepository
     */
    public function productRepository()
    {
        return new ProductRepository();
    }

    /**
     * Get All Tag Mapping With Relationships
     * 
     * @return mixed
     */
    public function getAllWithRelationships()
    {
    	return $this->repository()->allWithAllRelationships();
    }

    /**
     * Get TagMapping With Relationships by id
     * 
     * @return mixed
     */
    public function getTagMappingWithRelationships($id)
    {
        return $this->repository()->tagMappingWithAllRelationships($id);
    }


    /**
     * Get Tags By StoreId
     * 
     * @param  $storeId
     * @return mixed
     */
    public function getTagsByStoreId($storeId)
    {
        return $this->tagRepository()->dropdownTagsByStoreId($storeId);
    }

    /**
     * Get Products By StoreId
     * 
     * @param  $storeId
     * @return mixed
     */
    public function getProductsByStoreId($storeId)
    {
        return $this->productRepository()->dropdownProductsByStoreId($storeId);
    }
}
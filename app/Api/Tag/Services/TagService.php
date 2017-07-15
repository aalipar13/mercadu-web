<?php namespace App\Api\Tag\Services;

use Resource\Services\ResourceService;

use App\Api\Tag\Exceptions\TagException;

use App\Modules\ArkCommerce\Tag\Repositories\TagRepository;
use App\Modules\ArkCommerce\TagMapping\Repositories\TagMappingRepository;
use App\Modules\ArkCommerce\Product\Repositories\ProductRepository;
use App\Modules\ArkCommerce\Store\Repositories\StoreRepository;

use App\Modules\ArkCommerce\StorePhoto\Services\StorePhotoService;


class TagService extends ResourceService
{
    /**
     * @return TagRepository
     */
    public function repository()
    {
        return new TagRepository();
    }

    /**
     * @return TagMappingRepository
     */
    public function tagMappingRepository()
    {
        return new TagMappingRepository();
    }

    /**
     * @return ProductRepository
     */
    public function productRepository()
    {
        return new ProductRepository();
    }

    /**
     * @return StoreRepository
     */
    public function storeRepository()
    {
        return new StoreRepository();
    }

    /**
     * @return StorePhotoService
     */
    public function storePhotoService()
    {
        return new StorePhotoService();
    }

    /**
     * Finds all the menu based on the data
     * 
     * @param  $data
     * @return mixed
     */
    public function search($data)
    {
        $result =[];
        $stores = [];
        $tags = [];
        $i = 0;

        if (empty($data['q'])) {
            $data['q'] = '';
        }

        // get tags
        $tags = $this->repository()->search($data['q'])->toArray();

        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $productResult[] = $this->tagMappingRepository()->getProductsByTags($tag['id'], 'tag_mappings.tag_id');
            }

            foreach ($productResult as $perProduct) {
                foreach ($perProduct as $value) {

                    // store checking if in array
                    if (!(in_array($value['store_id'], $stores))) {
                        // push stores to array
                        // $result[$value['store_id']]['store']['id'] = $value['store_id'];
                        // $result[$value['store_id']]['store']['name'] = $value['store_name'];
                        // $result[$value['store_id']]['store']['slug'] = $value['store_slug'];
                        // $result[$value['store_id']]['store']['description'] = $value['store_description'];
                        
                        // $result[$value['store_id']]['store']['store_img'] = $value['store_img'];
                        
                        
                        

                        // $result[$value['store_id']]['store']['photos'] = $this->storePhotoService()->getPhotos($value['store_id']);
                    }

                    // push tags to array
                    // $result[$value['store_id']]['tags']['id'] = $value['tag_id'];
                    // $result[$value['store_id']]['tags']['name'] = $value['tag_name'];
                    // $result[$value['store_id']]['tags']['slug'] = $value['tag_slug'];
                    // $result[$value['store_id']]['tags']['store_id'] = $value['tag_store_id'];
                    // $result[$value['store_id']]['tags']['count'] = count($perProduct);


                    // push products under tags
                    $result['tags']['products'][$i]['id'] = $value['product_id'];
                    $result['tags']['products'][$i]['name'] = $value['product_name'];
                    $result['tags']['products'][$i]['description'] = $value['product_description'];
                    $result['tags']['products'][$i]['sale_price'] = $value['product_sale_price'];
                    $result['tags']['products'][$i]['photo'] = $value['product_photo'];

                    $stores[] = $value['store_id'];
                    $i++;
                }
            }
        }
        else {
            throw new TagException(TagException::UNABLE_FETCH_PRODUCTS);
        }

        return $result;
    }

}
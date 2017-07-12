<?php namespace App\Modules\ArkCommerce\TagMapping\Controllers;


use App\Modules\ArkCommerce\TagMapping\Requests\TagMappingRequest;
use App\Modules\ArkCommerce\TagMapping\Services\TagMappingService;

use App\Modules\ArkCommerce\Store\Services\StoreService;
use App\Modules\ArkCommerce\Tag\Services\TagService;
use App\Modules\ArkCommerce\Product\Services\ProductService;

use Resource\Controllers\ResourceController;
use Resource\Repositories\ResourceRepository;
use Resource\Services\ResourceService;

use App\Base\BaseRequest;

use Session;


class TagMappingController extends ResourceController
{
    /**
     * @return TagMappingRequest
     */
    protected function validation()
    {
        return new TagMappingRequest();
    }

    /**
     * @return TagMappingService
     */
    protected function service()
    {
        return new TagMappingService();
    }

    /**
     * @return StoreService
     */
    protected function storeService()
    {
        return new StoreService();
    }

    /**
     * @return TagService
     */
    protected function tagService()
    {
        return new TagService();
    }

    /**
     * @return ProductService
     */
    protected function productService()
    {
        return new ProductService();
    }

    /**
     * Retrieves all tag mapping data
     * 
     * @param  BaseRequest $request
     * @return mixed
     */
    public function index(BaseRequest $request)
    { 
        $result = $this->service->getAllWithRelationships();

        return view('admins.tag-mapping.index', compact('result'));
    }

    /**
     * Show the tag mapping form
     * 
     * @return View
     */
    public function create()
    {
        $stores = $this->storeService()->getStoresForDropdown();
        $tags = $this->tagService()->getTagsForDropdown();
        $products = $this->productService()->getProductsForDropdown();

        return view('admins.tag-mapping.store', compact('stores', 'tags', 'products'));
    }

    /**
     * Creates a new tag mapping record
     * 
     * @param  TagMappingRequest $request
     * @return mixed
     */
    public function save(TagMappingRequest $request)
    {
        $this->service()->create($request->all());

        Session::flash('alert-type', 'success');

        return redirect()->route('admin.tag-mapping.index')->with('status', 'Tag Mapping Created!');
    }

    /**
     * Updates a tag mapping record by id
     * 
     * @param  TagMappingRequest $request
     * @return mixed
     */
    public function revise($id, TagMappingRequest $request)
    {
        $this->service->update($id, $request->all());

        Session::flash('alert-type', 'info');

        return redirect()->back()->with('status', 'Tag Mapping Updated!');
    }

    /**
     * Retrieves specific tag mapping by id
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $tagMapping = $this->service->getTagMappingWithRelationships($id);

        return view('admins.tag-mapping.show', compact('tagMapping'));
    }

    /**
     * Show the edit form of the tag mapping
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $tagMapping = $this->service()->getById($id);
        $stores = $this->storeService()->getStoresForDropdown();
        $tags = $this->service()->getTagsByStoreId($tagMapping['store_id']);
        $products = $this->service()->getProductsByStoreId($tagMapping['store_id']);

        return view('admins.tag-mapping.edit', compact('tagMapping', 'stores', 'tags', 'products'));
    }

    /**
     * Deletes a tag mapping record by id
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->service->delete($id);

        Session::flash('alert-type', 'danger');

        return redirect()->back()->with('status', 'Tag Mapping Deleted!');
    }

    
    /**
     * Fetch Tags by Store Id
     * 
     * @param  $storeId
     * @return mixed
     */
    public function fetchTags($storeId)
    {
        return $this->service()->getTagsByStoreId($storeId);
    }

    /**
     * Fetch Products by Store Id
     * 
     * @param  $storeId
     * @return mixed
     */
    public function fetchProducts($storeId)
    {
        return $this->service()->getProductsByStoreId($storeId);
    }
}
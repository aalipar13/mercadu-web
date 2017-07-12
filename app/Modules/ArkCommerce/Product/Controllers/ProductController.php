<?php namespace App\Modules\ArkCommerce\Product\Controllers;


use App\Modules\ArkCommerce\Product\Requests\ProductRequest;
use App\Modules\ArkCommerce\Product\Services\ProductService;

use App\Modules\ArkCommerce\Store\Services\StoreService;

use Resource\Controllers\ResourceController;
use Resource\Repositories\ResourceRepository;
use Resource\Services\ResourceService;

use Session;

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
            $result = $this->service->allProductsWithPagination($records);
        }

        return view('admins.product.index', compact('result'));
    }

    /**
     * Show the product form
     * 
     * @return View
     */
    public function create()
    {
        $stores = $this->storeService()->getStoresForDropDown();

        return view('admins.product.store', compact('stores'));
    }

    /**
     * Creates a new product record
     * 
     * @param  CategoryRequest $request
     * @return mixed
     */
    public function save(ProductRequest $request)
    {
        $this->service()->create($request);

        Session::flash('alert-type', 'success');

        return redirect('/admin/product/index?records=10')->with('status', 'Product Created!');
    }

    /**
     * Updates a product record by id
     * 
     * @param  productRequest $request
     * @return mixed
     */
    public function revise($id, ProductRequest $request)
    {
        $this->service->revise($id, $request);

        Session::flash('alert-type', 'info');

        return redirect()->back()->with('status', 'Product Updated!');
    }

    /**
     * Retrieves specific product by id
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $product = $this->service->getProductWithStore($id);

        return view('admins.product.show', compact('product'));
    }

    /**
     * Show the edit form of the product
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $product = $this->service->getById($id);
        $stores = $this->storeService()->getStoresForDropDown();

        return view('admins.product.edit', compact('product', 'stores'));
    }

    /**
     * Deletes a product record by id
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->service->deleteProductWithPhoto($id);

        Session::flash('alert-type', 'danger');

        return redirect('/admin/product/index?records=10')->with('status', 'Product Deleted!');
    }
}
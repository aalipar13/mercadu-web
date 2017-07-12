<?php namespace App\Modules\ArkCommerce\Category\Controllers;


use App\Modules\ArkCommerce\Category\Requests\CategoryRequest;
use App\Modules\ArkCommerce\Category\Services\CategoryService;

use App\Modules\ArkCommerce\Store\Services\StoreService;

use Resource\Controllers\ResourceController;
use Resource\Repositories\ResourceRepository;
use Resource\Services\ResourceService;

use App\Base\BaseRequest;

use Session;


class CategoryController extends ResourceController
{
    /**
     * @return BaseRequest
     */
    protected function validation()
    {
        return new CategoryRequest();
    }

    /**
     * @return ResourceService
     */
    protected function service()
    {
        return new CategoryService();
    }

    /**
     * @return ResourceService
     */
    protected function storeService()
    {
        return new StoreService();
    }

    /**
     * Retrieves all category data
     * 
     * @param  BaseRequest $request
     * @return mixed
     */
    public function index(BaseRequest $request)
    {
        $records = $request->get('records');
 
        if (empty($records))
        {
            $result['categoryList'] = $this->service->getAllWithStore();
        } 
        else
        {
            $result = $this->service->allCategoriesWithPagination($records);
        }

        return view('admins.category.index', compact('result'));
    }

    /**
     * Show the category form
     * 
     * @return View
     */
    public function create()
    {
        $stores = $this->storeService()->getStoresForDropdown();

        return view('admins.category.store', compact('stores'));
    }

    /**
     * Creates a new Category Record
     * 
     * @param  CategoryRequest $request
     * @return mixed
     */
    public function save(CategoryRequest $request)
    {
        $this->service()->create($request->all());

        Session::flash('alert-type', 'success');

        return redirect('/admin/category/index?records=10')->with('status', 'Category Created!');
    }

    /**
     * Updates a category record by id
     * 
     * @param  CategoryRequest $request
     * @return mixed
     */
    public function revise($id, CategoryRequest $request)
    {
        $this->service->update($id, $request->all());

        Session::flash('alert-type', 'info');

        return redirect()->back()->with('status', 'Category Updated!');
    }

    /**
     * Retrieves specific category by id
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $category = $this->service->getCategoryWithStore($id);

        return view('admins.category.show', compact('category'));
    }

    /**
     * Show the edit form of the category
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $category = $this->service->getById($id);
        $stores = $this->storeService()->getStoresForDropdown();

        return view('admins.category.edit', compact('category', 'stores'));
    }

    /**
     * Deletes a category record by id
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->service->delete($id);

        Session::flash('alert-type', 'danger');

        return redirect('/admin/category/index?records=10')->with('status', 'Category Deleted!');
    }
}
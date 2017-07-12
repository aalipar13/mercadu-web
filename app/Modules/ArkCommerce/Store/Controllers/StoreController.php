<?php namespace App\Modules\ArkCommerce\Store\Controllers;


use App\Modules\ArkCommerce\Store\Requests\StoreRequest;
use App\Modules\ArkCommerce\Store\Services\StoreService;

use App\Modules\ArkCommerce\StorePhoto\Services\StorePhotoService;

use Resource\Controllers\ResourceController;
use Resource\Repositories\ResourceRepository;
use Resource\Services\ResourceService;

use Illuminate\Support\Facades\Input;

use App\Base\BaseRequest;

use Session;


class StoreController extends ResourceController
{
    /**
     * @return BaseRequest
     */
    protected function validation()
    {
        return new StoreRequest();
    }

    /**
     * @return ResourceService
     */
    protected function service()
    {
        return new StoreService();
    }

    /**
     * Retrieves all store data
     * 
     * @param  BaseRequest $request
     * @return mixed
     */
    public function index(BaseRequest $request)
    {
        $records = $request->get('records');
 
        if (empty($records))
        {
            $result['storeList'] = $this->service->getAll();
        } 
        else
        {
            $result = $this->service->allStoresWithPagination($records);
        }

        return view('admins.store.index', compact('result'));
    }

    /**
     * Show the Store form
     * 
     * @return View
     */
    public function create()
    {
        return view('admins.store.store');
    }

    /**
     * Creates a new Store Record
     * 
     * @param  StoreRequest $request
     * @return mixed
     */
    public function save(StoreRequest $request)
    {
        // Check if no file is uploaded
        if (!($request->hasFile('photo'))) {
            return redirect()->back()->withInput(Input::all())->withErrors('No file uploaded.');
        }

        $this->service()->create($request);

        Session::flash('alert-type', 'success');

        return redirect('/admin/store/index?records=10')->with('status', 'Store Created!');
    }

    /**
     * Updates a Store Record by id
     * 
     * @param  StoreRequest $request
     * @return mixed
     */
    public function revise($id, StoreRequest $request)
    {
        $this->service->revise($id, $request);

        Session::flash('alert-type', 'info');

        return redirect()->back()->with('status', 'Store Updated!');
    }

    /**
     * Retrieves Specific Store by id
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $store = $this->service->getStoreWithPhotos($id);

        return view('admins.store.show', compact('store'));
    }

    /**
     * Show the edit form of the store
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $store = $this->service->getStoreWithPhotos($id);

        return view('admins.store.edit', compact('store'));
    }

    /**
     * Deletes a store record by id
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->service->delete($id);

        Session::flash('alert-type', 'danger');

        return redirect('/admin/store/index?records=10')->with('status', 'Store Deleted!');
    }
}
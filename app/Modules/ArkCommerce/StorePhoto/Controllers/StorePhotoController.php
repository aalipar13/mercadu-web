<?php namespace App\Modules\ArkCommerce\StorePhoto\Controllers;


use App\Modules\ArkCommerce\Store\Services\StoreService;
use App\Modules\ArkCommerce\StorePhoto\Requests\StorePhotoRequest;
use App\Modules\ArkCommerce\StorePhoto\Services\StorePhotoService;

use Resource\Controllers\ResourceController;
use Resource\Repositories\ResourceRepository;
use Resource\Services\ResourceService;

use Illuminate\Support\Facades\Input;

use App\Base\BaseRequest;

use Session;


class StorePhotoController extends ResourceController
{
    /**
     * @return StorePhotoService
     */
    protected function service()
    {
        return new StorePhotoService();
    }

    /**
     * @return StoreService
     */
    protected function storeService()
    {
        return new StoreService();
    }

    /**
     * Creates a new Store Record
     * 
     * @param  StoreRequest $request
     * @return mixed
     */
    public function save($id, StorePhotoRequest $request)
    {
        // Check if no file is uploaded
        if (!($request->hasFile('addPhoto'))) {
            return redirect()->back()->withInput(Input::all())->withErrors('No file uploaded.');
        }

        $this->service()->save($id, $request);

        Session::flash('alert-type', 'success');

        return redirect()->back()->with('status', 'Store Photo Created!');
    }

    /**
     * Deletes a store record by id
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->service->deletePhoto($id);

        Session::flash('alert-type', 'danger');

        return redirect()->back()->with('status', 'Store Photo Deleted!');
    }

    /**
     * Updates a Store Record by id
     * 
     * @param  StoreRequest $request
     * @return mixed
     */
    public function revise($id, StorePhotoRequest $request)
    {
        // Check if no file is uploaded
        if (!($request->hasFile('updatePhoto'))) {
            return redirect()->back()->withInput(Input::all())->withErrors('No file uploaded.');
        }

        $this->service()->revise($id, $request);

        Session::flash('alert-type', 'info');

        return redirect()->back()->with('status', 'Store Photo Updated!');
    }

    /**
     * Store Photos
     * 
     * @return mixed
     */
    public function photos($id)
    {
        $store = $this->storeService()->getStoreWithPhotos($id);

        return view('admins.store.photo', compact('store'));
    }

}
<?php namespace App\Modules\ArkCommerce\Tag\Controllers;


use App\Modules\ArkCommerce\Tag\Requests\TagRequest;
use App\Modules\ArkCommerce\Tag\Services\TagService;

use App\Modules\ArkCommerce\Store\Services\StoreService;

use Resource\Controllers\ResourceController;
use Resource\Repositories\ResourceRepository;
use Resource\Services\ResourceService;

use App\Base\BaseRequest;

use Session;


class TagController extends ResourceController
{
    /**
     * @return BaseRequest
     */
    protected function validation()
    {
        return new TagRequest();
    }

    /**
     * @return ResourceService
     */
    protected function service()
    {
        return new TagService();
    }

    /**
     * @return ResourceService
     */
    protected function storeService()
    {
        return new StoreService();
    }

    /**
     * Retrieves all tag data
     * 
     * @param  BaseRequest $request
     * @return mixed
     */
    public function index(BaseRequest $request)
    {
        $records = $request->get('records');
 
        if (empty($records))
        {
            $result['tagList'] = $this->service->getAllWithStore();
        } 
        else
        {
            $result = $this->service->allTagsWithPagination($records);
        }

        return view('admins.tag.index', compact('result'));
    }

    /**
     * Show the Tag form
     * 
     * @return View
     */
    public function create()
    {
        $stores = $this->storeService()->getStoresForDropdown();

        return view('admins.tag.store', compact('stores'));
    }

    /**
     * Creates a new Tag Record
     * 
     * @param  TagRequest $request
     * @return mixed
     */
    public function save(TagRequest $request)
    {
        $this->service()->create($request->all());

        Session::flash('alert-type', 'success');

        return redirect('/admin/tag/index?records=10')->with('status', 'Tag Created!');
    }

    /**
     * Updates a tag Record by id
     * 
     * @param  TagRequest $request
     * @return mixed
     */
    public function revise($id, TagRequest $request)
    {
        $this->service->update($id, $request->all());

        Session::flash('alert-type', 'info');

        return redirect()->back()->with('status', 'Tag Updated!');
    }

    /**
     * Retrieves specific tag by id
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $tag = $this->service->getTagWithStore($id);

        return view('admins.tag.show', compact('tag'));
    }

    /**
     * Show the edit form of the tag
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $tag = $this->service->getById($id);
        $stores = $this->storeService()->getStoresForDropdown();

        return view('admins.tag.edit', compact('tag', 'stores'));
    }

    /**
     * Deletes a tag record by id
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->service->delete($id);

        Session::flash('alert-type', 'danger');

        return redirect('/admin/tag/index?records=10')->with('status', 'Tag Deleted!');
    }
}
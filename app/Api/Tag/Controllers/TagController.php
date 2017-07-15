<?php namespace App\Api\Tag\Controllers;

use App\Api\Tag\Services\TagService;

use App\Base\BaseRequest;

use Resource\Controllers\ResourceController;
use Resource\Repositories\ResourceRepository;
use Resource\Services\ResourceService;


class TagController extends ResourceController
{
    /**
     * @return TagService
     */
    protected function service()
    {
        return new TagService();
    }

    /**
     * Searches for the menu
     * 
     * @param  BaseRequest $request
     * @return Response
     */
    public function search(BaseRequest $request)
    {
        $data = $request->all();

        return $this->success($this->service()->search($data));
    }
}
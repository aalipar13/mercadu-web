<?php namespace App\Api\UserDetail\Controllers;


use App\Base\BaseRequest;

use App\Api\UserDetail\Services\UserDetailService;

use Resource\Controllers\ResourceController;
use Resource\Repositories\ResourceRepository;
use Resource\Services\ResourceService;


class UserDetailController extends ResourceController
{

    /**
     * @return BaseRequest
     */
    protected function validation()
    {
        return new BaseRequest();
    }

    /**
     * @return UserDetailService
     */
    protected function service()
    {
        return new UserDetailService();
    }


    /**
     * Retrieves user account information by id
     *
     * @param $id
     * @return mixed
     */
    public function getAccountInfoById($id)
    {
        return $this->success($this->service->getAccountInfoById($id));
    }

}

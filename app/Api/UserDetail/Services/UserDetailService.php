<?php namespace App\Api\UserDetail\Services;


use App\Api\UserDetail\Repositories\UserDetailRepository;

use Resource\Services\ResourceService;


class UserDetailService extends ResourceService
{
    /**
     * @return UserDetailRepository
     */
    public function repository()
    {
        return new UserDetailRepository();
    }


    /**
     * Creates a new User Detail Record
     *
     * @param  $userDetail
     * @return mixed
     */
    public function createUserDetail($userDetail)
    {
        $result = $this->repository()->create($userDetail);

        return $this->repository()->find($result['id']);
    }

    /**
     * Retrieves user account information by id
     *
     * @param $id
     * @return mixed
     */
    public function getAccountInfoById($id)
    {
        return $this->repository->getAccountInfoById($id);
    }
}

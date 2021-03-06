<?php namespace App\Api\UserDetail\Services;


use Resource\Services\ResourceService;

use App\Api\UserDetail\Repositories\UserDetailRepository;

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
}
<?php namespace App\Api\UserDetail\Repositories;


use App\Common\Models\UserDetail;

use Resource\Repositories\ResourceRepository;

class UserDetailRepository extends ResourceRepository
{
    /**
     * @return UserDetail
     */
    public function model()
    {
        return UserDetail::class;
    }

    /**
     * Search UserDetails based on keywords
     * 
     * @param  $keywords
     * @return mixed
     */
    public function searchUserDetails($keywords)
    {
        $result = $this->model->where("first_name", "LIKE", '%'.$keywords.'%')
                              ->orwhere("last_name", "LIKE", '%'.$keywords.'%')
                              ->orwhere("mobile", "LIKE", '%'.$keywords.'%')
                              ->with('user')
                              ->paginate(10)
                              ->toArray();

        return $result;
    }
}
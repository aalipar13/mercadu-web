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
     * Retrieves user account information by id
     *
     * @param $id
     * @return mixed
     */
    public function getAccountInfoById($id)
    {
        return $this->model->select('users.email', 'users.username', 'users.type', 'user_details.*')
                    ->where('users.id', $id)
                    ->join('users', 'user_details.user_id', '=', 'users.id')
                    ->first()->toArray();
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

    /**
     * Updates user reward points by user id
     *
     * @param $userId, $rewardPoints
     * @return mixed
     */
    public function updateRewardPoints($userId, $rewardPoints)
    {
        return $this->model->where('user_id', $userId)->update(array('reward_points' => $rewardPoints));
    }
}

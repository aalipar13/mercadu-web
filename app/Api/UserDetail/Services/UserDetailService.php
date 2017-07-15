<?php namespace App\Api\UserDetail\Services;


use App\Api\UserDetail\Repositories\UserDetailRepository;

use Resource\Services\ResourceService;

use Auth;


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
        $accountInfo = $this->repository->getAccountInfoById($id);

        $curl = curl_init();
        curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api-uat.unionbankph.com/uhac/sandbox/accounts/".$accountInfo['bank_account_number'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "x-ibm-client-id: 629b0fc0-f83c-4802-abd0-3ebc6bf11c19",
                "x-ibm-client-secret: G3gN3hW0hR2hR6yA1aK1uN7aG5pW5wJ1cM7aM1oP8iI6eM7wD5"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err)
        {
          echo "cURL Error #:" . $err;
        }
        else
        {
            $info = json_decode($response);
            $accountInfo['bank_account_info'] = $info;

            return $accountInfo;
        }
    }


    /**
     * Retrieves user details by user id
     *
     * @param $userId
     * @return mixed
     */
    public function getByUserId($userId)
    {
        return $this->repository->getByUserId($userId);
    }

    /**
     * Updates user reward points by user id
     *
     * @param $userId, $amount
     * @return mixed
     */
    public function updateRewardPoints($userId, $amount)
    {
        $rewardPoints = $amount * 0.05;

        return $this->repository->updateRewardPoints($userId, $rewardPoints);
    }
}

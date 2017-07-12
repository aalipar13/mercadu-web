<?php namespace App\Modules\Registration\Services;


use Resource\Services\ResourceService;

use App\Modules\Registration\Repositories\RegistrationRepository;

use App\Api\UserDetail\Services\UserDetailService;

// use App\Http\Controllers\Email\Services\EmailService;

use Auth;

use Config;


class RegistrationService extends ResourceService
{
    /**
     * @return RegistrationRepository
     */
    public function repository()
    {
        return new RegistrationRepository();
    }

    /**
     * @return UserDetailService
     */
    public function userDetailService()
    {
        return new UserDetailService();
    }

    /**
     * @return EmailService
     */
    // public function emailService()
    // {
    //     return new EmailService();
    // }

    /**
     * Creates a new users record
     * 
     * @param  $data
     * @return 
     */
    public function createUser($data)
    {
        $userData = [
                        'email' => $data['email'],
                        'password' => $data['password'],
                        'type' => $data['type'],
                    ];

        $user = $this->repository()->create($userData);

        $userDetail = [
                        'user_id' => $user['id'], 
                        'first_name' => $data['first_name'], 
                        'last_name' => $data['last_name'], 
                        'mobile' => $data['mobile'], 
                      ];

        $userResult = $this->repository()->find($user['id']);

        // send email to user
        // $this->emailService()->registration($data);

        $userDetailResult = $this->userDetailService()->createUserDetail($userDetail);

        //auto login after successful registration
        // Auth::loginUsingId($userResult['id']);

        // $token = Auth::user()->createToken('caterspice')->accessToken;

        // $userResult['token'] = $token;

        return [
                'user' => $userResult,
                'userDetail' => $userDetailResult
               ];
    }
}
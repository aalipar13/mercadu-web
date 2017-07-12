<?php namespace App\Modules\Registration\Repositories;


use App\User;

use Resource\Repositories\ResourceRepository;

class RegistrationRepository extends ResourceRepository
{
    /**
     * @return User
     */
    public function model()
    {
        return User::class;
    }
}
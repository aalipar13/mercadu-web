<?php namespace App\Api\Customer\Auth\Controllers;


use Auth\Controllers\AuthController;
use Auth\Events\UserHasLoggedIn;
use Auth\Exceptions\AuthException;
use Auth\Requests\AuthRequest;

use Illuminate\Http\Request;

use Auth;

use Laravel\Passport\TokenRepository;


class CustomerAuthController extends AuthController
{

}
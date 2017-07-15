<?php namespace App\Api\Customer\Auth\Controllers;

use App\Base\BaseController;

use App\Api\Customer\Auth\Requests\CustomerAuthRequest;

use Auth\Controllers\AuthController;
use Auth\Events\UserHasLoggedIn;
use Auth\Exceptions\AuthException;

use Illuminate\Http\Request;

use Auth;

use Laravel\Passport\TokenRepository;


class CustomerAuthController extends BaseController
{
    /**
     *  Authenticate the user customer
     *
     * @param CustomerAuthRequest $request
     * @return mixed
     * @throws Auth\Exceptions\AuthException
     */
    public function login(CustomerAuthRequest $request)
    {
        $credentials = $request->only('username', 'password');

        try
        {
            // attempt to verify the credentials and create a token for the user
            if (!(Auth::attempt($credentials)))
            {
                $this->error(new AuthException(AuthException::INVALID_CREDENTIAL));
            }

            $token = Auth::user()->createToken('mercadu')->accessToken;
        }
        catch (Exception $e)
        {
            $this->error(new AuthException(AuthException::UNABLE_CREATE_TOKEN));
        }

        $userData = Auth::user()->toArray();

        // dispatch event that user has logged in
        $this->dispatcher->fire(new UserHasLoggedIn($userData));

        $userData['token'] = $token;

        // all good so return the token
        return $this->success($userData);
    }
}

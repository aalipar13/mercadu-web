<?php namespace App\Http\Controllers\Admin\Auth\Controllers;


use App\Base\BaseController;

use Auth\Requests\AuthRequest;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AdminAuthController extends BaseController
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admins.auth.login');
    }

    /**
     * Handle a login request to the application.
     * 
     * @param  AuthRequest $request
     * @return View
     */
    public function login(AuthRequest $request)
    {
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        else {
            return $this->sendFailedLoginResponse($request);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/admin/login');
    }

    /**
     * Authenticated page
     * 
     * @return View
     */
    public function home()
    {
        return view('admins.home.index');
    }
}
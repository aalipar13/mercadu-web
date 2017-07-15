<?php namespace App\Modules\Registration\Controllers;

use App\Modules\Registration\Requests\RegistrationRequest;
use App\Modules\Registration\Services\RegistrationService;

use App\Base\BaseRequest;

use Resource\Controllers\ResourceController;
use Resource\Repositories\ResourceRepository;
use Resource\Services\ResourceService;


class RegistrationController extends ResourceController
{

    /**
     * @return BaseRequest
     */
    protected function validation()
    {
        return new RegistrationRequest();
    }

    /**
     * @return ResourceService
     */
    protected function service()
    {
        return new RegistrationService();
    }

    /**
     * Store a new user record
     *
     * @param  RegistrationRequest $request
     * @return mixed
     */
    public function register(RegistrationRequest $request)
    {
        $userData = $request->all();

        return $this->success($this->service->createUser($userData));

        // return redirect($result['redirectURL']);
    }

    /**
     * Show Registration Form
     */
    public function showForm()
    {
        return view('registration.index');
    }
}

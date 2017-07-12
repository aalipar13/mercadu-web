<?php namespace App\Base;


use App\Base\Traits\ApiResponse;

use Illuminate\Validation\ValidationException;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;


/**
 * Base class for Controllers
 *
 * Class BaseController
 * @package App\Base
 */
class BaseController extends Controller
{
    use ApiResponse, ValidatesRequests;


    /**
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher) {

        $this->dispatcher = $dispatcher;
    }


    /**
     *
     *
     * @param \Illuminate\Http\Request $request
     * @param $validator
     */
    protected function throwValidationException(\Illuminate\Http\Request $request, $validator) {
        throw new ValidationException($validator, response($validator->errors()));
    }
}
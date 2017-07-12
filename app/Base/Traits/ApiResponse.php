<?php namespace App\Base\Traits;


use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

/**
 * Trait for api success and error
 *
 * Trait ApiResponse
 * @package App\Base\Traits
 */
trait ApiResponse
{
    /**
     * @param $data
     * @param null $transformer
     * @param string $message
     * @param int $statusCode
     * @return mixed
     */
    public function success($data = null, $transformer = null, $message = 'success', $statusCode = 200)
    {
        $response = [];
        $response['message'] = $message;
        $response['status_code'] = $statusCode;
        $response['data'] = $data;

        return !is_null($data) ? is_null($transformer) ? response($response) : response($response, $transformer) : response([]);
    }


    /**
     * @param $exception
     */
    public function error($exception)
    {
        if($exception)
        {
            throw $exception;
        }
    }
}

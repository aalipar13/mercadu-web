<?php namespace App\Base;


use Illuminate\Foundation\Http\FormRequest;


/**
 * Base class for Requests
 *
 * Class BaseRequest
 * @package App\Base
 */
class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
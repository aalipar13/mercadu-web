<?php namespace App\Api\Customer\Auth\Requests;


use App\Base\BaseRequest;


class CustomerAuthRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return [
            'username' => 'required|max:12',
            'password' => 'required|min:6'
       ];
    }
}

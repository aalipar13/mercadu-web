<?php namespace App\Modules\Registration\Requests;


use App\Base\BaseRequest;


class RegistrationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',

            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'mobile' => 'required|digits:10|unique:user_details',
            'birth_date' => 'required|date_format:Y-m-d',
            'type' => 'required|in:customer, merchant, admin'
        ];
    }
}
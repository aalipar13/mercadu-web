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
            'username' => 'required|max:12|unique:users,username',
            'password' => 'required|min:6',
            'type' => 'required',

            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'birth_date' => 'required|date_format:Y-m-d',
            'mobile' => 'required|digits:10|unique:user_details',
            'bank_account_number' => 'required'
        ];
    }
}

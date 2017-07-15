<?php namespace App\Api\Cart\Requests;

use App\Base\BaseRequest;


class CartRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|numeric',
        ];
    }
}
<?php namespace App\Modules\ArkCommerce\TagMapping\Requests;


use App\Base\BaseRequest;


class TagMappingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'store_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'tag_id' => 'required|numeric'
        ];
    }
}
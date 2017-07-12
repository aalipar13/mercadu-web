<?php namespace App\Modules\ArkCommerce\Category\Requests;


use App\Base\BaseRequest;


class CategoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'store_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'max:255'
        ];
    }
}
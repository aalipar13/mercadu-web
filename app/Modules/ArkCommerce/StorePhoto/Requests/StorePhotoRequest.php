<?php namespace App\Modules\ArkCommerce\StorePhoto\Requests;


use App\Base\BaseRequest;


class StorePhotoRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                 'addPhoto.*' => 'image:png,jpeg,jpg',
                 'updatePhoto.*' => 'image:png,jpeg,jpg',
               ];
    }
}
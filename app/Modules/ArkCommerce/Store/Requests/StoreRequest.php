<?php namespace App\Modules\ArkCommerce\Store\Requests;


use App\Base\BaseRequest;


class StoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'PUT':
            {
                return [
                    'name' => 'required|max:255',
                    'description' => 'min:6',
                    // 'order_notice' => 'required|numeric',
                    // 'min_orders' => 'required|between:0, 9999999999.99',
                    // 'delivery' => 'required',
                    // 'budget' => 'required'
                ];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|max:255',
                    'description' => 'min:6',
                    // 'order_notice' => 'required|numeric',
                    // 'min_orders' => 'required|between:0, 9999999999.99',
                    // 'delivery' => 'required',
                    // 'budget' => 'required',

                    'photo.*' => 'image:jpeg,jpg,png',
                ];
            }
            default:break;
        }
        
    }
}
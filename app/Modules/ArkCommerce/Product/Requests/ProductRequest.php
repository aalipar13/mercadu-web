<?php namespace App\Modules\ArkCommerce\Product\Requests;


use App\Base\BaseRequest;


class ProductRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => '',
            'store_id' => 'required',
            'photo' => 'required|image',
            'type' => 'required',
            'code' => 'required',
            'quantity' => 'required|integer',
            // 'min_quantity' => 'required|integer',
            'should_manage_stock' => '',
            'available' => '',
            'is_sold_individually' => '',

            'regular_price' => 'required|between:0, 9999999999.99',
            'sale_price' => 'required|between:0, 9999999999.99',
            // 'sale_price_start_date_at' => 'required|date',
            // 'sale_price_end_date_at' => 'required|date',

            'weight' => '',
            'length' => '',
            'width' => '',
            'height' => '',

            'sort_order' => '',
            'purchase_note' => '',
            'should_allow_reviews' => '',
        ];
    }
}
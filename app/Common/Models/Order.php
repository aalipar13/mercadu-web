<?php

namespace App\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'customer_id',

        'total',
        'subtotal',
        'deposit',
        'discount',
        'subtotal_discount',
        'shipping',
        'status',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'billing_address_1',
        'billing_address_2',
        'billing_state',
        'billing_zip_code',
        'billing_city',
        'billing_country',
        'shipping_address_1',
        'shipping_address_2',
        'shipping_state',
        'shipping_zip_code',
        'shipping_city',
        'shipping_country',

        'merchant_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

    // For soft delete
    protected $dates = ['deleted_at'];

    // RELATIONSHIPS
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany('App\Common\Models\OrderDetail');
    }
}

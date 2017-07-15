<?php namespace App\Common\Models;


use App\Base\BaseModel;

use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'store_id',
        'photo',
        'type',
        'code',
        'quantity',
        'min_quantity',
        'should_manage_stock',
        'available',
        'is_sold_individually',

        'regular_price',
        'sale_price',
        'sale_price_start_date_at',
        'sale_price_end_date_at',

        'weight',
        'length',
        'width',
        'height',

        'sort_order',
        'purchase_note',
        'should_allow_reviews',
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
     * Product belongs to a Store
     */
    public function store()
    {
        return $this->belongsTo('App\Common\Models\Store');
    }
}

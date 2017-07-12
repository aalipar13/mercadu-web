<?php namespace App\Common\Models;


use App\Base\BaseModel;

use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends BaseModel
{
    use SoftDeletes;

    protected $id = 'id';

    protected $name = 'name';

    protected $description = 'description';

    protected $store_id = 'store_id';

    protected $photo = 'photo';

    protected $type = 'type';

    protected $code = 'code';

    protected $quantity = 'quantity';

    protected $min_quantity = 'min_quantity';

    protected $should_manage_stock = 'should_manage_stock';

    protected $available = 'available';

    protected $is_sold_individually = 'is_sold_individually';

    protected $regular_price = 'regular_price';

    protected $sale_price = 'sale_price';

    protected $sale_price_start_date_at = 'sale_price_start_date_at';

    protected $sale_price_end_date_at = 'sale_price_end_date_at';

    protected $weight = 'weight';

    protected $length = 'length';

    protected $width = 'width';

    protected $height = 'height';

    protected $sort_order = 'sort_order';

    protected $purchase_note = 'purchase_note';

    protected $should_allow_reviews = 'should_allow_reviews';



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

    //for soft delete
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
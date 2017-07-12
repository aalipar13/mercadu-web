<?php namespace App\Common\Models;


use App\Base\BaseModel;

use App\Base\Traits\CascadeDelete;

use Illuminate\Database\Eloquent\SoftDeletes;


class Store extends BaseModel
{
    use SoftDeletes, CascadeDelete;

    protected $id = 'id';

    protected $name = 'name';

    protected $slug = 'slug';

    protected $description = 'description';

    protected $order_notice = 'order_notice';

    protected $store_img = 'store_img';

    protected $delivery = 'delivery';

    protected $min_orders = 'min_orders';

    protected $budget = 'budget';

    //cascading delete
    protected $cascadeDeletes = ['tag', 'category', 'product', 'storePhoto'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', 'order_notice', 'store_img', 'delivery', 'min_orders', 'budget'
    ];

    //for soft delete
    protected $dates = ['deleted_at'];

    // RELATIONSHIPS

    /**
     * Store has many Tags
     */
    public function tag()
    {
        return $this->hasMany('App\Common\Models\Tag');
    }

    /**
     * Store has many Categories
     */
    public function category()
    {
        return $this->hasMany('App\Common\Models\Category');
    }

    /**
     * Store has many Products
     */
    public function product()
    {
        return $this->hasMany('App\Common\Models\Product');
    }

    /**
     * Store has many Store Photo
     */
    public function storePhoto()
    {
        return $this->hasMany('App\Common\Models\StorePhoto');
    }
}
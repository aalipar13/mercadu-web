<?php namespace App\Common\Models;


use App\Base\BaseModel;

use App\Base\Traits\CascadeDelete;

use Illuminate\Database\Eloquent\SoftDeletes;


class Store extends BaseModel
{
    use SoftDeletes, CascadeDelete;

    // For cascading delete
    protected $cascadeDeletes = ['tag', 'category', 'product', 'storePhoto'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'order_notice',
        'store_img',
        'delivery',
        'min_orders',
        'budget'
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

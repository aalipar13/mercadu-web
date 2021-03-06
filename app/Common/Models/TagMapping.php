<?php namespace App\Common\Models;


use App\Base\BaseModel;

use Illuminate\Database\Eloquent\SoftDeletes;


class TagMapping extends BaseModel
{
    use SoftDeletes;

    protected $id = 'id';

    protected $store_id = 'store_id';

    protected $product_id = 'product_id';

    protected $tag_id = 'tag_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id', 'product_id', 'tag_id'
    ];

    //for soft delete
    protected $dates = ['deleted_at'];

    //RELATIONSHIPS

    /**
     * Tag Mapping belongs to Store
     */
    public function store()
    {
        return $this->belongsTo('App\Common\Models\Store');
    }

    /**
     * Tag Mapping belongs to Tag
     */
    public function tag()
    {
        return $this->belongsTo('App\Common\Models\Tag');
    }

    /**
     * Tag Mapping belongs to Product
     */
    public function product()
    {
        return $this->belongsTo('App\Common\Models\Product');
    }
}
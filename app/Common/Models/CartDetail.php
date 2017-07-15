<?php namespace App\Common\Models;


use App\Base\BaseModel;
// use Illuminate\Database\Eloquent\SoftDeletes;

class CartDetail extends BaseModel
{
    // use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
       'cart_id',
       'product_id',
       'delivery_at',
       'insured'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = ['deleted_at'];

    // For soft delete
    // protected $dates = ['deleted_at'];

    // RELATIONSHIPS
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Common\Models\Product');
    }
}

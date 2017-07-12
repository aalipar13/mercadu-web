<?php namespace App\Common\Models;


use App\Base\BaseModel;

use Illuminate\Database\Eloquent\SoftDeletes;


class StorePhoto extends BaseModel
{
    use SoftDeletes;

    protected $id = 'id';

    protected $store_id = 'store_id';

    protected $photo = 'photo';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id', 'photo'
    ];

    //for soft delete
    protected $dates = ['deleted_at'];

    // RELATIONSHIPS

    /**
     * StorePhoto belongs to Store
     */
    public function store()
    {
        return $this->belongsTo('App\Common\Models\Store');
    }
}
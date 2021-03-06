<?php namespace App\Common\Models;


use App\Base\BaseModel;

use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends BaseModel
{
    use SoftDeletes;

    protected $id = 'id';

    protected $store_id = 'store_id';

    protected $name = 'name';

    protected $description = 'description';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id', 'name', 'description'       
    ];

    //for soft delete
    protected $dates = ['deleted_at'];

    // RELATIONSHIPS

    /**
     * Tag belongs to a Store
     */
    public function store()
    {
        return $this->belongsTo('App\Common\Models\Store');
    }
}
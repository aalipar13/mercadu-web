<?php namespace App\Common\Models;


use App\Base\BaseModel;

use Illuminate\Database\Eloquent\SoftDeletes;


class UserDetail extends BaseModel
{
    use SoftDeletes;

    protected $id = 'id';

    protected $user_id = 'user_id';

    protected $first_name = 'first_name';

    protected $last_name = 'last_name';

    protected $birth_date = 'birth_date';

    protected $mobile = 'mobile';

    protected $is_account_verified = 'is_account_verified';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'birth_date', 'mobile', 'is_account_verified'
    ];


    //for soft delete
    protected $dates = ['deleted_at'];

    //RELATIONSHIPS
    
    /**
     * CustomerDetail belongs to User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * UserMenuOrder has one UserDetail
     */
    public function userMenuOrder()
    {
        return $this->hasMany('App\Common\Models\UserMenuOrder');
    }
}
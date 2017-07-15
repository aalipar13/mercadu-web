<?php namespace App\Common\Models;


use App\Base\BaseModel;

use Illuminate\Database\Eloquent\SoftDeletes;


class UserDetail extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'birth_date',
        'mobile',
        'is_account_verified',
        'bank_account_number',
        'reward_points'
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

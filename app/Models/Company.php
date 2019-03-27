<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Company extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'openid', 'nickname' , 'phone', 'password', 'avatar', 'sex', 'source','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 一对一 微信公众号
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wechatMp()
    {
        return $this->hasOne('App\Models\WechatMp');
    }

    /**
     * is_nav 修改器
     *
     * @param $value
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value == 'off' || !$value ? 0 : 1;
    }

    /**
     * 多对多 获取企业下的所有用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User','user_company_shop')->withPivot('shop_id','remark','status');
    }
}

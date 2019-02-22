<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Agent extends Authenticatable
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
     * 多对多-商品
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function goods()
    {
        return $this->belongsToMany('App\Models\Goods');
    }

    /**
     * 多对多-广告位
     *
     * @param int $way 广告位编码
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ad($way=1)
    {
        return $this->belongsToMany('App\Models\Goods','agent_ad')->wherePivot('way',$way);
    }
}

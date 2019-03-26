<?php

namespace App\Models;

class ManagerWechatWeb extends Model
{
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'openid',
        'nickname',
        'headimgurl',
        'sex',
        'language',
        'country',
        'province',
        'city',
        'privilege',
        'unionid',
        'refresh_token',
        'expires',
        'register_token'
    ];
}

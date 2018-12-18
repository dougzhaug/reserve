<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentWechatWeb extends Model
{
    //
//    protected $table = 'agent_wechat_webs';
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
        'expires'
    ];
}

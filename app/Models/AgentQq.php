<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentQq extends Model
{
    //
    protected $fillable = [
        'openid',
        'name',
        'email',
        'nickname',
        'is_lost',
        'gender',
        'province',
        'city',
        'year',
        'constellation',
        'figureurl',
        'figureurl_1',
        'figureurl_2',
        'figureurl_qq_1',
        'figureurl_qq_2',
        'is_yellow_vip',
        'vip',
        'yellow_vip_level',
        'level',
        'is_yellow_year_vip',
        'unionid',
        'refresh_token',
        'expires',
    ];
}

<?php

namespace App\Models;


class WechatMp extends Model
{
    //
    protected $fillable = [
        'company_id',
        'nick_name',
        'qrcode_url',
        'user_name',
        'principal_name',
        'alias',
        'signature',
        'business_info',
        'service_type_info',
        'verify_type_info',
        'authorizer_appid',
        'authorizer_refresh_token',
        'pagefriends_count',
        'func_info'
    ];

    /**
     * 微信公众号 1V1 代理商
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        return $this->belongsTo('App\Models\Agent');
    }
}

<?php

namespace App\Models;


class ManagerWeibo extends Model
{
    //
    protected $fillable = [
        'uid',
        'openid',
        'name',
        'email',
        'screen_name',
        'gender',
        'location',
        'lang',
        'province',
        'city',
        'description',
        'followers_count',
        'friends_count',
        'pagefriends_count',
        'statuses_count',
        'video_status_count',
        'favourites_count',
        'created_time',
        'avatar_large',
        'avatar_hd',
        'bi_followers_count',
        'credit_score',
        'refresh_token',
        'expires',
    ];
}

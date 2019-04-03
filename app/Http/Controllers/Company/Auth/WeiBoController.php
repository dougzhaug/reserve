<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Models\ManagerWeibo;
use Laravel\Socialite\Facades\Socialite;

class WeiBoController extends Controller
{
    //

    const USER_SOURCE = 3;
    /**
     * Redirect the user to the WeiXinWeb authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::with('weibo')->redirect();
    }

    /**
     * Obtain the user information from WeiXinWeb.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $raw = Socialite::driver('weibo')->user();

        //通过用户信息查询数据库信息
        $weibo = ManagerWeibo::where('uid',$raw->id)->first();

        if(!$weibo){
            $user = $raw->user;
            $user['uid'] = $raw->id;
            $user['openid'] = md5($raw->id);
            $user['name'] = $raw->name ? : '';
            $user['email'] = $raw->email ? : '';
            $user['created_time'] = isset($user['created_at']) ? $user['created_at'] : '';
            $user['refresh_token'] = $raw->refreshToken ? : '';
            $user['expires'] = date('Y-m-d H:i:s',time()+config('services.sns_user_update_expires'));
            $weibo = ManagerWeibo::create($user);
        }

        unset($weibo->id);

        //加companies表数据
        $create_data = [
            'source'=> self::USER_SOURCE,
            'username' => make_username(),
            'nickname' => $raw->nickname,
            'sex' => $weibo['gender'] ? $weibo['gender']=='m' ? 1 : 2 : 0,
            'avatar' => $weibo['avatar_large'],
            'password'=> bcrypt(config('services.sns_user_login_password')),
        ];

        return (new SnsLoginController())->login(array_merge($create_data,$weibo->toArray()));
    }
}

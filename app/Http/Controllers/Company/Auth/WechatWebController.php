<?php

namespace App\Http\Controllers\Company\Auth;

use App\Models\ManagerWechatWeb;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class WechatWebController extends Controller
{
    //
    const USER_SOURCE = 1;

    /**
     * Redirect the user to the WeiXinWeb authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::with('weixinweb')->redirect();
    }

    /**
     * Obtain the user information from WeiXinWeb.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $raw = Socialite::driver('weixinweb')->user();

        //通过用户信息查询数据库信息
        $wechat = ManagerWechatWeb::where('openid',$raw->id)->first();

        if(!$wechat){
            $user = $raw->user;
            $user['refresh_token'] = $raw->refreshToken;
            $user['privilege'] = json_encode($user['privilege']);
            $user['expires'] = date('Y-m-d H:i:s',time()+config('services.sns_user_update_expires'));
            $wechat = ManagerWechatWeb::create($user);
        }

        //加companies表表数据
        $create_data = [
            'source'=> self::USER_SOURCE,
            'username' => make_username(),
            'avatar' => $wechat['headimgurl'],
            'password'=> bcrypt(config('services.sns_user_login_password')),
        ];

        return (new SnsLoginController())->login(array_merge($create_data,$wechat->toArray()));
    }
}

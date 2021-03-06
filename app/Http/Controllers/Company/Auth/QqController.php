<?php

namespace App\Http\Controllers\Company\Auth;

use App\Models\ManagerQq;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class QqController extends Controller
{
    //

    const USER_SOURCE = 2;
    /**
     * Redirect the user to the WeiXinWeb authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::with('qq')->redirect();
    }

    /**
     * Obtain the user information from WeiXinWeb.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $raw = Socialite::driver('qq')->user();

        //通过用户信息查询数据库信息
        $qq = ManagerQq::where('openid',$raw->id)->first();

        if(!$qq){
            $user = $raw->user;
            $user['openid'] = $raw->id;
            $user['name'] = $raw->name?:'';
            $user['email'] = $raw->email?:'';
            $user['unionid'] = $raw->unionid;
            $user['refresh_token'] = $raw->refreshToken;
            $user['expires'] = date('Y-m-d H:i:s',time()+config('services.sns_user_update_expires'));
            $qq = ManagerQq::create($user);
        }

        //加companies表表数据
        $create_data = [
            'source'=> self::USER_SOURCE,
            'username' => make_username(),
            'sex' => $qq['gender'] ? $qq['gender']=='男' ? 1 : 2 : 0,
            'avatar' => $qq['figureurl_qq_2'],
            'password'=> bcrypt(config('services.sns_user_login_password')),
        ];

        return (new SnsLoginController())->login(array_merge($create_data,$qq->toArray()));
    }
}

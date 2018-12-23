<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Models\AgentQq;
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
        $agent_qq = AgentQq::where('openid',$raw->id)->first();

        if(!$agent_qq){
            $user = $raw->user;
            $user['openid'] = $raw->id;
            $user['name'] = $raw->name?:'';
            $user['email'] = $raw->email?:'';
            $user['unionid'] = $raw->unionid;
            $user['refresh_token'] = $raw->refreshToken;
            $user['expires'] = date('Y-m-d H:i:s',time()+config('services.sns_user_update_expires'));
            $agent_qq = AgentQq::create($user);
        }

        //加agents表数据
        $create_data = [
            'source'=> self::USER_SOURCE,
            'username' => 'B_' . str_random(8),
            'sex' => $agent_qq['gender'] ? $agent_qq['gender']=='男' ? 1 : 2 : 0,
            'avatar' => $agent_qq['figureurl_qq_2'],
            'password'=> bcrypt(config('services.sns_user_login_password')),
        ];

        return (new SnsLoginController())->login(array_merge($create_data,$agent_qq->toArray()));
    }
}

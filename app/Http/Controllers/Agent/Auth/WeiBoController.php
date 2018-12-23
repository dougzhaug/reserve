<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Http\Controllers\Controller;
use App\Models\AgentWeibo;
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

        $openid = 'weibo-' . $raw->id;
//        dd($raw);die;
        //通过用户信息查询数据库信息
        $agent_weibo = AgentWeibo::where('openid',$openid)->first();

        if(!$agent_weibo){
            $user = $raw->user;
            $user['openid'] = $openid;
            $user['name'] = $raw->name?:'';
            $user['email'] = $raw->email?:'';
            $user['created_time'] = isset($user['created_at']) ? $user['created_at'] : '';
            $user['refresh_token'] = $raw->refreshToken ? : '';
            $user['expires'] = date('Y-m-d H:i:s',time()+config('services.sns_user_update_expires'));
            $agent_weibo = AgentWeibo::create($user);
        }

        unset($agent_weibo->id);

        //加agents表数据
        $create_data = [
            'source'=> self::USER_SOURCE,
            'username' => 'B_' . str_random(8),
            'nickname' => $raw->nickname,
            'sex' => $agent_weibo['gender'] ? $agent_weibo['gender']=='m' ? 1 : 2 : 0,
            'avatar' => $agent_weibo['avatar_large'],
            'password'=> bcrypt(config('services.sns_user_login_password')),
        ];

        return (new SnsLoginController())->login(array_merge($create_data,$agent_weibo->toArray()));
    }
}

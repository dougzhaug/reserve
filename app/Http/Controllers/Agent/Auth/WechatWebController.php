<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Models\AgentWechatWeb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class WechatWebController extends Controller
{
    //
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
        $agent_wechat = AgentWechatWeb::where('openid',$raw->id)->first();
        if(!$agent_wechat){

            $user = $raw->user;
            $user['refresh_token'] = $raw->refreshToken;
            $user['privilege'] = json_encode($user['privilege']);
            $user['expires'] = date('Y-m-d H:i:s',time()+config('services.sns_user_update_expires'));
            $agent_wechat = AgentWechatWeb::create($user);
        }
        $agent_wechat->source = 1;
        session('sns_agent', $agent_wechat);

        $login = new SnsLoginController();
        return $login->login($agent_wechat);
    }

}

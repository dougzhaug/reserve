<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SnsLoginController extends Controller
{
    /**
     * 第三方登录
     *
     * @param $sns_agent //需要先处理好所需要的数据
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login($sns_agent)
    {
        $agent = Agent::where('openid',$sns_agent['openid'])->first();

        if($agent){ //登录
            if (Auth::guard('agent')->attempt(['openid'=>$agent['openid'],'password'=>config('services.sns_user_login_password')])) {
                if(!$agent['authorize_status']){    //公众号未授权
                    try{
                        return redirect()->action('Agent\Auth\SnsRegisterController@showRegistrationForm');
                    }catch (\Exception $e){
                        dd($e->getMessage());die;
                    }
                }else{
                    //跳转首页或来源页面
                    return redirect()->intended('dashboard');
                }
            }
        }else{//注册
            return (new SnsRegisterController())->register($sns_agent);
        }

    }
}

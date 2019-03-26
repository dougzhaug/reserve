<?php

namespace App\Http\Controllers\Company\Auth;


use App\Models\Manager;
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
        $agent = Manager::where('openid',$sns_agent['openid'])->first();

        if($agent){ //登录
            if (Auth::guard('company')->attempt(['openid'=>$agent['openid'],'password'=>config('services.sns_user_login_password')])) {
                if($agent['authorize_status']){    //公众号未授权
                    return redirect()->action('Company\Auth\SnsRegisterController@showRegistrationForm');
                }else{
                    //跳转首页或来源页面
                    return redirect()->intended('/');
                }
            }
        }else{//注册
            return (new SnsRegisterController())->register($sns_agent);
        }

    }
}

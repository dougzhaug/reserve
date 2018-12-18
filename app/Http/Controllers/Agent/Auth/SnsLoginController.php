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
     * @param $sns_agent
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login($sns_agent)
    {
        if(isset($sns_agent['agents_id']) && $sns_agent['agents_id']){  //登录
            $agent = Agent::find($sns_agent['agents_id']);
            if($agent){
                if (Auth::guard('agent')->attempt(['phone'=>$agent['phone'],'password'=>123456])) {
                    // 认证通过...
                    return redirect()->intended('/');
                }
            }

        }else{  //注册

        }
    }
}

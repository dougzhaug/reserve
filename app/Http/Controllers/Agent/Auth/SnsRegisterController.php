<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SnsRegisterController extends Controller
{
    //
    public function showRegistrationForm()
    {
        return view('agent.auth.sns_register');
    }

    public function register(array $data)
    {
        $agent = Agent::create($data);

        if (Auth::guard('agent')->attempt(['openid'=>$agent['openid'],'password'=>config('services.sns_user_login_password')])) {
            if(!$agent['authorize_status']){    //公众号未授权
                return redirect()->action('Agent\Auth\SnsRegisterController@showRegistrationForm');
            }else{
                // 认证通过...
                return redirect()->intended('dashboard');
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Company\Auth;


use App\Models\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SnsRegisterController extends Controller
{

    /**
     * 第三方注册页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showRegistrationForm(Request $request)
    {
        $url = '';
        if($request->register_step != 3){
            //判断是否已经授权过了
            if(Auth::guard('company')->user()['authorize_status']){
                return redirect('/');
            }

            //获取开放平台授权url
            $openPlatform = app('wechat.open_platform');
            $url = $openPlatform->getPreAuthorizationUrl(url('open-platform/callback'));
        }

        return view('agent.auth.sns_register',['authorize_url'=>$url]);
    }

    /**
     * 第三方注册流程
     *
     * @param array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(array $data)
    {
        $user = Manager::create($data);

        RegisterController::autoAssignRoles($user);

        if (Auth::guard('company')->attempt(['openid'=>$user['openid'],'password'=>config('services.sns_user_login_password')])) {
            if($user['authorize_status']){    //公众号未授权
                return redirect()->action('Company\Auth\SnsRegisterController@showRegistrationForm');
            }else{
                // 认证通过...
                return redirect()->intended('/');
            }
        }
    }
}

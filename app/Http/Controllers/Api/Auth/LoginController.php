<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $agent_id = Hashids::decode($request->agent)[0] ?? 0;   //需要前端传递

        if(!$agent_id){
            return '<script>alert("数据异常")</script>';
        }

        $redirect = url('authorized/callback').$request->uri?:'';

        $mp = Agent::find($agent_id)->wechatMp;

        $openPlatform = app('wechat.open_platform');
        $app = $openPlatform->officialAccount($mp['authorizer_appid']);
        $response = $app->oauth->scopes(['snsapi_userinfo'])->redirect($redirect);
        return $response;
    }

    public function callback(Request $request)
    {
        $openPlatform = app('wechat.open_platform');
        $app = $openPlatform->officialAccount($request->appid);
        $user = $app->oauth->user();
        $userModel = User::where('openid',$user->getId())->first();
        if(!$userModel){
            $create = $user->getOriginal();
            $create['privilege'] = json_encode($create['privilege']);
            $userModel = User::create($create);
        }
        $token = auth('api')->login($userModel);
//        dd($token);die;
        return $token;
    }
}

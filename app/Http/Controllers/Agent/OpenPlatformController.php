<?php
/**
 * 微信开放平台
 */
namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use App\Models\WechatMp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OpenPlatformController extends AgentAuthController
{
    //
    public function serve(Request $request)
    {
        $openPlatform = app('wechat.open_platform');
        $authorization = $openPlatform->handleAuthorize();

        if(isset($authorization['errcode']) && $authorization['errcode'] > 0){
            return back()->withErrors(['网络异常，请重新授权！(' . $authorization['errmsg'] . ')'])->withInput();
        }

        $authorizeInfo = $openPlatform->getAuthorizer($authorization['authorization_info']['authorizer_appid']);

        if(isset($authorizeInfo['errcode']) && $authorizeInfo['errcode'] > 0){
            return back()->withErrors(['网络异常，请重新授权！(' . $authorizeInfo['errmsg'] . ')'])->withInput();
        }

        $old_mp = WechatMp::where('user_name',$authorizeInfo['authorizer_info']['user_name'])->first();

        if($old_mp){
            return error('该公众号已经被 [ ' . $old_mp->agent['nickname'] . ' ] 绑定！(如有疑问请联系客服)');
//            return back()->withErrors(['该公众号已经被 [ ' . $old_mp->agent['nickname'] . ' ] 绑定！(如有疑问请联系客服)'])->withInput();
        }

        $create = array_merge($authorizeInfo['authorizer_info'],$authorizeInfo['authorization_info']);

        $create['agent_id'] = Auth::user()['id'];
        $create['service_type_info'] = $create['service_type_info']['id'];
        $create['verify_type_info'] = $create['verify_type_info']['id'];
        $create['business_info'] = json_encode($create['business_info']);
        $create['func_info'] = json_encode($create['func_info']);

        DB::beginTransaction();
        try{
            $wechat_mp = WechatMp::create($create);

            $agent = Agent::find(Auth::user()['id']);
            $agent->authorize_status = 1;
            $agent->save();

            DB::commit();

            return redirect()->action('Agent\Auth\SnsRegisterController@showRegistrationForm',['register_step'=>3]);
        } catch (\Exception $e){
            DB::rollback();//事务回滚
            return back()->withErrors(['网络异常，请重新授权！(' . $e->getMessage() . ')'])->withInput();
        }

    }
}

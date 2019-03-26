<?php
/**
 * 微信开放平台
 */
namespace App\Http\Controllers\Company;

use App\Models\Agent;
use App\Models\WechatMp;
use EasyWeChat\OpenPlatform\Server\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OpenPlatformController extends AuthController
{
    //
    public function serve()
    {

        $openPlatform = app('wechat.open_platform');

        $server = $openPlatform->server;
        // 处理授权成功事件，其他事件同理
        $server->push(function ($message) {
            report($message);
            Log::info($message);
        }, Guard::EVENT_AUTHORIZED);

        // 处理授权更新事件
        $server->push(function ($message) {
            report($message);
            Log::info($message);
        }, Guard::EVENT_UPDATE_AUTHORIZED);

        // 处理授权取消事件
        $server->push(function ($message) {
            report($message);
            Log::info($message);
        }, Guard::EVENT_UNAUTHORIZED);

        return $server->serve();

    }

    public function callback()
    {
        $openPlatform = app('wechat.open_platform');

        $authorization = $openPlatform->handleAuthorize();

        if(isset($authorization['errcode']) && $authorization['errcode'] > 0){
            return error('网络异常，请重新授权！(' . $authorization['errmsg'] . ')');
        }

        $authorizeInfo = $openPlatform->getAuthorizer($authorization['authorization_info']['authorizer_appid']);

        if(isset($authorizeInfo['errcode']) && $authorizeInfo['errcode'] > 0){
            return error('网络异常，请重新授权！(' . $authorizeInfo['errmsg'] . ')');
        }

        $old_mp = WechatMp::where('user_name',$authorizeInfo['authorizer_info']['user_name'])->first();

        if($old_mp){
            return error('该公众号已经被 [ ' . $old_mp->agent['nickname'] . ' ] 绑定！(如有疑问请联系客服)');
        }

        $create = array_merge($authorizeInfo['authorizer_info'],$authorizeInfo['authorization_info']);

        $create['agent_id'] = Auth::user()['id'];
        $create['service_type_info'] = $create['service_type_info']['id'];
        $create['verify_type_info'] = $create['verify_type_info']['id'];
        $create['business_info'] = json_encode($create['business_info']);
        $create['func_info'] = json_encode($create['func_info']);

        DB::beginTransaction();
        try{
            WechatMp::create($create);

            $agent = Agent::find(Auth::user()['id']);
            $agent->authorize_status = 1;
            $agent->save();

            DB::commit();

            return redirect()->action('Agent\Auth\SnsRegisterController@showRegistrationForm',['register_step'=>3]);
        } catch (\Exception $e){
            DB::rollback();//事务回滚
            return error('网络异常，请重新授权！(' . $e->getMessage() . ')');
        }
    }
}

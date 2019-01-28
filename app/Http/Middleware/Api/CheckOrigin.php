<?php

namespace App\Http\Middleware\Api;

use App\Models\WechatMp;
use Closure;

class CheckOrigin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            preg_match("#http://(.*?)\.#i",$_SERVER['HTTP_ORIGIN'],$origin);    //暂无https
            $mp = WechatMp::where('authorizer_appid',$origin[1])->first();
            if(!$mp) throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException('AccessDenied(Permission denied)');
        }catch (\Exception $e){
            throw new \Dingo\Api\Exception\ResourceException('ResourceException('.$e->getMessage().')');
        }

        header("Access-Control-Allow-Origin:" . $_SERVER['HTTP_ORIGIN']);

        $request->mp = $mp;

        return $next($request);
    }
}

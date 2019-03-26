<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BeforeRequest
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
        $user = Auth::user();
        $request->user = $user??null;                 //统一获取用户信息
        $request->company = $user->company??null;     //统一获取企业信息
        $request->role = $user->roles->toArray()[0]['id']??[];   //用户角色信息

        return $next($request);
    }

}

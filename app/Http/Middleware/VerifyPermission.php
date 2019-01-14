<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class VerifyPermission
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return \Illuminate\Http\Response|mixed
     */
    public function handle($request, Closure $next, $guard=null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            $route = Request::route()->getName();  //获取当前路由别名
            if(!$user->can($route)){                //注：未定义路由别名的将不受权限管理
                return response()->view('403', [], 403);
            }
        }
        return $next($request);
    }
}

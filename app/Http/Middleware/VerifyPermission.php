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
            if(!$user->can($this->getRouteName())){                //注：未定义路由别名的将不受权限管理
                return response()->view('403', [], 403);
            }
        }
        return $next($request);
    }

    private function getRouteName()
    {
        $route = Request::route()->getName();  //获取当前路由别名
        $routeArr = explode('.',$route);
        $last = array_pop($routeArr);
        if($last == 'store'){
            $routeArr[] = 'create';
            $route = implode('.',$routeArr);
        }
        if($last == 'update'){
            $routeArr[] = 'edit';
            $route = implode('.',$routeArr);
        }

        return $route;
    }
}

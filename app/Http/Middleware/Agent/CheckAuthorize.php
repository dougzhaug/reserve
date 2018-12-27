<?php

namespace App\Http\Middleware\Agent;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuthorize
{
    /**
     * The URIs that should be excluded from Authorize verification.
     *
     * @var array
     */
    protected $except = [
        //
        'auth/*',
        'login',
        'register',
        'authorize',
        'logout',
        'open-platform/*',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $agent = Auth::guard('agent')->user();

        if(
            !$this->inExceptArray($request) &&
            !$agent['authorize_status']
        ){
            return redirect()->action('Agent\Auth\SnsRegisterController@showRegistrationForm');
        }

        return $next($request);
    }

    /**
     * Determine if the request has a URI that should pass through Authorize verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }

        return false;
    }
}

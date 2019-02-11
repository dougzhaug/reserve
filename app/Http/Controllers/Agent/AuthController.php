<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    //
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $agent;
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware([
            'auth:agent',
            'permission:agent',
            'menu:agent'
        ]);
    }


}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AuthController extends BaseController
{
    //
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $agent;
    public function __construct(Request $request)
    {
        parent::__construct();
//        $this->middleware('auth:api');
    }
}

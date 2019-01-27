<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('api.checkOrigin');
    }
}

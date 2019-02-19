<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MallsController extends AuthController
{
    //
    public function index()
    {
        return view('agent.malls.index');
    }
}

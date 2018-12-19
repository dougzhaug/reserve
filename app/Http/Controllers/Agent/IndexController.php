<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends AgentAuthController
{
    //

    public function index()
    {
        return view('agent.index.index');
    }
}

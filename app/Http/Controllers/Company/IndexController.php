<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends AuthController
{
    //

    public function index(Request $request)
    {
        return view('agent.index.index');
    }

    public function test()
    {
        return back()->withErrors(['查不到这个用户，请检查！'])->withInput();
    }

    public function demo()
    {
        return view('layouts.demo');
    }
}

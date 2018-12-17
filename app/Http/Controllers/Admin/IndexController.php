<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class IndexController extends BaseController
{
    //
    public function index()
    {
        return view('admin.index.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminsController extends BaseController
{
    //
    public function index()
    {
        return view('admin.admins.index');
    }

    public function create()
    {
        return view('admin.admins.index');
    }
}

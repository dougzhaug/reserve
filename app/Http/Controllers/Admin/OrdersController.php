<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class OrdersController extends BaseController
{
    //
    public function index()
    {
        return view('admin.orders.index');
    }
}

<?php

namespace App\Http\Controllers\Agent\Rbac;

use App\Http\Controllers\Agent\AgentAuthController;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends AgentAuthController
{
    //
    /**
     * list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $permissionsAll = Permission::orderBy('sort','desc')->get();
        $permissions = make_tree_to_array($permissionsAll);
        dd($permissions);die;

        return view('agent.rbac.permissions.index',['permissions'=>$a]);
    }

    /**
     * 添加页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $permission = Permission::orderBy('sort','desc')->get();

        $permissions = make_tree_for_select($permission,$request->pid);

        $permissions = ['代理商管理'=>2,'管理员管理'=>3];
        $permissions = [['name'=>'篮球','value'=>3],['name'=>'足球','value'=>5,'selected'=>true],['name'=>'乒乓球','value'=>10]];

        return view('agent.rbac.permissions.create',['permission'=>$permissions]);
    }
}

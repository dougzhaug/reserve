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

        return view('agent.rbac.permissions.index',['permissions'=>$permissions]);
    }

    /**
     * 添加页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $permission = Permission::select('id','alias as name', 'id as value','pid')->orderBy('sort','desc')->get();
        $permissions = make_tree_to_array($permission);
        array_unshift($permissions,['name'=>'请选择','value'=>0]);

        return view('agent.rbac.permissions.create',['permission'=>$permissions,'selected'=>$request->id]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required','unique:permissions'],
            'alias' => ['required','unique:permissions'],
        ]);

        $permission = Permission::create($request->post());

        if($permission){
            return success('添加成功','permissions');
        }else{
            return error('网络异常');
        }
    }
}

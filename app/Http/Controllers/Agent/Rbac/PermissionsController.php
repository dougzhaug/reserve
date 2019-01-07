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
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $columns = $request->columns;

            $builder = Permission::select(['id','name as rule','pid','url','alias as name','sort','remark','icon','is_nav','created_at']);

            /* where start*/

            if($request->keyword){
                $builder->where($request->action_field,'like','%'.$request->keyword.'%');
            }

            /* where end */

            //获取总条数
            $total = $builder->count();

            /* order start */

            if($request->order){
                $order = $request->order[0];
                $order_column = $columns[$order['column']]['data'];
                $order_dir = $order['dir'];
                $builder->orderBy($order_column,$order_dir);
            }else{
                $builder->orderBy('sort','asc');
            }

            /* order end */

            $data = $builder->get();

            $data = make_tree_to_array($data);

            return [
                'draw' => intval($request->draw),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data,
            ];
        }

        return view('agent.rbac.permissions.index');
    }

    /**
     * 添加页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('agent.rbac.permissions.create',[
            'permission_select'=>Permission::getSelectArray(),
            'selected'=>$request->id
        ]);
    }

    /**
     * 添加
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * 编辑
     *
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        return view('agent.rbac.permissions.edit',[
            'permission'=>$permission,
            'permission_select'=>Permission::getSelectArray($permission['pid'])
        ]);
    }

    /**
     * @param Permission $permission
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Permission $permission,Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'alias' => ['required'],
        ]);

        $result = $permission::update($request->post());

        if($result){
            return success('添加成功','permissions');
        }else{
            return error('网络异常');
        }
    }

}

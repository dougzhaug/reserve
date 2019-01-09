<?php

namespace App\Http\Controllers\Agent\Rbac;

use App\Http\Controllers\Agent\AgentAuthController;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Guard;

class RolesController extends AgentAuthController
{

    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $builder = Role::where('guard_name',Guard::getDefaultName(static::class))
                ->select(['id','name','status','depict','created_at']);

            /* where start*/
            if($request->keyword){
                $builder->where($request->action_field,'like','%'.$request->keyword.'%');
            }
            /* where end */

            //count
            $total = $builder->count();

            /* order start */
            if($request->order){
                $builder->orderBy($request->columns[$request->order[0]['column']]['data'],$request->order[0]['dir']);
            }
            /* order end */

            $data = $builder->offset($request->start)->take($request->length)->get()->toArray();

            return [
                'draw' => intval($request->draw),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data,
            ];
        }

        return view('agent.rbac.roles.index');
    }

    /**
     * 添加页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('agent.rbac.roles.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => ['required','unique:roles'],
            'permissions' => ['required'],
        ]);

        $create = [
            'name' => $request->name,
            'depict' => $request->depict ? : '',
            'status' => $request->status ? : 0,
            'js_tree_ids' => $request->js_tree_ids,
        ];

        $role = Role::create($create);

        if(!$role){
            return error('网络异常');
        }

        $permission_ids = explode(',',$request->permissions) ? : 0;

        $permissions = Permission::whereIn('id',$permission_ids)->get();

        $result = $role->syncPermissions($permissions);

        if($result){
            return success('添加成功','roles');
        }else{
            return error('网络异常');
        }
    }

    public function edit(Role $role)
    {
        return view('agent.rbac.roles.edit',['role'=>$role]);
    }

    public function update(Request $request, Role $role)
    {
        //
        $this->validate($request, [
            'name' => ['required'],
            'permissions' => ['required'],
        ]);

        $update = [
            'name' => $request->name,
            'depict' => $request->depict ? : '',
            'status' => $request->status ? : 0,
            'js_tree_ids' => $request->js_tree_ids,
        ];

        $res = $role->update($update);

        if(!$res){
            return error('网络异常');
        }

        $permission_ids = explode(',',$request->permissions) ? : 0;       //选中的权限id  explode(',',"1,10,100,101,203,303,305");

        $permissions = Permission::whereIn('id',$permission_ids)->get();

        $result = $role->syncPermissions($permissions);

        if($result){
            return success('编辑成功','roles');
        }else{
            return error('网络异常');
        }
    }

    /**
     * 用于展示树状权限数据
     *
     * @param Request $request
     * @param Role $role
     * @return array
     */
    public function permission_tree(Request $request,Role $role)
    {
        if($request->ajax()){
            $permissionAll = Permission::where('is_nav',1)->get(['id','alias as text','pid','icon']);

//            //处理系统中必须的权限（例如，消息提示页面）
//            foreach ($permissionAll as $key=>$val){
//                if(in_array(400,explode(',',$val['pids'])) || $val['id'] == 400){
//                    /*
//                     * opened 展开
//                     * disabled 禁用
//                     * selected 选中
//                     */
//                    $permissionAll[$key]['state'] = ['opened'=>false,'disabled'=>true,'selected'=>true];
//                }
//            }

            if($role){     //编辑状态
                $rolePermissions = explode(',',$role->js_tree_ids);        //获取角色的权限id
                foreach ($permissionAll as $k=>$v){
                    if(in_array($v['id'],$rolePermissions)){
                        $v['state'] = array_merge($v['state']?:[],['selected'=>true]);
                    }
                }
            }

            $permissions = make_tree($permissionAll);
            return $permissions;
        }
    }
}

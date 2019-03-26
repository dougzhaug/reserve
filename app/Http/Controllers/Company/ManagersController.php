<?php

namespace App\Http\Controllers\Company;

use App\Models\Agent;
use App\Models\Manager;
use App\Models\Role;
use App\Rules\Phone;
use Illuminate\Http\Request;
use Spatie\Permission\Guard;

class ManagersController extends AuthController
{
    /**
     * 首页
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $builder = Manager::select(['id','openid','username','sex','avatar','phone','nickname','authorize_status','status','source','created_at']);

            /* where start*/
            if($request->keyword){
                $builder->where($request->current_field,'like','%'.$request->keyword.'%');
            }

            if($request->date_range){
                $builder->whereBetween('created_at',[$request->start_date,$request->end_date]);
            }
            /* where end */

            //获取总条数
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

        $dropdowns = ['name'=>'姓名','phone'=>'手机号','email'=>'邮箱'];
        return view('company.managers.index',['dropdowns'=>$dropdowns]);
    }

    /**
     * 新增页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::where(['status'=>1,'guard_name'=>Guard::getDefaultName(static::class)])
            ->select('id','id as value','name')->get()->toArray();
        return view('company.managers.create',['roles'=>$roles]);
    }

    /**
     * 新增
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validator($request->all(),[
            'name' => 'required|string|max:255',
            'phone' => ['required','unique:admins',new phone()],
            'email' => 'string|email|max:255|unique:admins',
            'password' => 'required|string|min:6',
            'permissions' => 'required',
        ]);

        $create = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $user = Manager::create($create);

        if(!$user){
            return error('网络异常');
        }

        $result = $user->assignRole($request->permissions);

        if($result){
            return success('添加成功','managers');
        }else{
            return error('网络异常');
        }

    }

    /**
     * 展示页面
     *
     * @param Manager $manager
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Manager $manager)
    {
        return view('company.managers.show');
    }

    /**
     * 编辑页面
     *
     * @param Manager $manager
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Manager $manager)
    {
        $roles = Role::where(['status'=>1,'guard_name'=>Guard::getDefaultName(static::class)])
            ->select('id','id as value','name')->get()->toArray();
        $manager_roles = array_column($manager->roles->toArray(),'id') ? : [];  //获取当前用户的角色
        return view('company.managers.edit',['manager'=>$manager,'roles'=>$roles,'manager_roles'=>$manager_roles]);
    }

    /**
     * 编辑
     *
     * @param Request $request
     * @param Manager $manager
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Manager $manager)
    {
        $this->validator($request->all(),[
            'username' => 'required|string|max:255',
            'roles' => 'required',
        ]);

        $update = [
            'username' => $request->username,
            'nickname' => $request->nickname,
            'status' => $request->status,
        ];

        $manager_result = $manager->update($update);
        if(!$manager_result){
            return error('网络异常');
        }

        $result = $manager->syncRoles($request->roles);
        if($result){
            return success('编辑成功','managers');
        }else{
            return error('网络异常');
        }
    }

    /**
     * 删除
     *
     * @param Manager $manager
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Manager $manager)
    {
        $result = $manager->delete();
        if($result){
            return success('删除成功','role');
        }else{
            return error('网络异常');
        }
    }

    /**
     * 状态切换
     *
     * @param Manager $manager
     * @param Request $request
     * @return array
     */
    public function status(Manager $manager,Request $request)
    {
        $result = $manager->update(['status'=>$request->status ? 0 : 1]);
        if($result){
            return ['errorCode'=>0,'message'=>'修改成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }
}

<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //
    /**
     * 默认权限
     * @return array
     */
    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_posts',
            'add_posts',
            'edit_posts',
            'delete_posts',
        ];
    }

    /**
     * icon 修改器
     *
     * @param $value
     */
    public function setIconAttribute($value)
    {
        $this->attributes['icon'] = $value ? : config('permission.icon');
    }

    /**
     * is_nav 修改器
     *
     * @param $value
     */
    public function setIsNavAttribute($value)
    {
        $this->attributes['is_nav'] = !isset($value) || $value == 'off' || !$value ? 0 : 1;
    }

    /**
     * 获取下拉菜单数据
     *
     * @param bool $id
     * @return array
     */
    public static function getSelectArray($id=false)
    {
        $permission = self::where('guard_name',Guard::getDefaultName(static::class))->select('id','title as name', 'id as value','pid')->orderBy('sort','desc')->get();
        if($id){
            foreach ($permission as $key=>$val){
                if($val['value'] == $id) $permission[$key]['selected'] = true;
            }
        }

        $permissions = make_tree_to_array($permission);
        array_unshift($permissions,['name'=>'请选择','value'=>0]);

        return $permissions;
    }
}

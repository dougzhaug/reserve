<?php

namespace App\Models;


class Permission extends \Spatie\Permission\Models\Permission
{
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
        $this->attributes['is_nav'] = $value == 'off' || !$value ? 0 : 1;
    }

    public static function getSelectArray($id=false)
    {
        $permission = self::select('id','alias as name', 'id as value','pid')->orderBy('sort','desc')->get();
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

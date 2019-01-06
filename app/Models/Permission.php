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
     * is_nav 访问器
     *
     * @param $value
     * @return string
     */
    public function getIsNavAttribute($value)
    {
        return $value ? 'on' : 'off';
    }

    /**
     * is_nav 修改器
     *
     * @param $value
     */
    public function setIsNavAttribute($value)
    {
        $this->attributes['is_nav'] = $value == 'on' || $value ? 1 : 0;
    }
}

<?php

if (!function_exists('has_permission')) {

    /**
     * 检查用户是否拥有指定权限
     * @param $user
     * @param $permission
     * @return bool
     */
    function has_permission($user, $permission)
    {
        foreach ($permission->actions as $action) {
            if ($user->denies($action)) {
                return false;
            }
        }
        return true;
    }
}

if (!function_exists('has_role')) {
    /**
     * 检查用户是否拥有指定角色
     * @param $user
     * @param $role
     * @return bool
     */
    function has_role($user, $role)
    {
        foreach ($role->permissions as $permission) {
            if (!has_permission($user, $permission)) {
                return false;
            }
        }
        return true;
    }
}

if (!function_exists('sub_admin')) {
    /**
     * 检查一个用户是否拥是另一个用户的子用户
     * @param $user
     * @param $sub_admin
     * @return bool
     */
    function sub_admin($user, $sub_admin)
    {
        foreach ($sub_admin->actions as $action) {
            if ($user->denies($action)) {
                return false;
            }
        }
        return true;
    }
}

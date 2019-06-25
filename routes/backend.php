<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "web" middleware group. Enjoy building your Admin!
|
*/

Route::group(['middleware' => 'auth.admin'], function () {
    Route::get('/', 'HomeController@index')->name('RootDashboard');
});

Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout')->name('admin.logout');

// 需要登录的路由组。
Route::group([
    'middleware' => [
        'auth:admin',
        'permission:admin',
    ]
], function () {

    // 账号信息。
    Route::group([
        'prefix' => 'profile'
    ], function () {
        // 修改密码。
        Route::get('change-password', [
            'as' => 'RootChangePassword',
            'uses' => 'ProfileController@getChangePassword'
        ]);
        Route::post('change-password', [
            'as' => 'RootChangePasswordAction',
            'uses' => 'ProfileController@postChangePassword'
        ]);
    });

    // 管理员管理。
    Route::group([
        'prefix' => 'admin'
    ], function () {

        // 用户列表。
        Route::get('list', [
            'as' => 'RootAdminList',
            'uses' => 'AdminController@getList'
        ]);

        // 用户编辑页。
        Route::get('edit', [
            'as' => 'RootAdminEdit',
            'uses' => 'AdminController@getEdit'
        ]);

        // 保存编辑。
        Route::post('save', [
            'as' => 'RootAdminEditAction',
            'uses' => 'AdminController@postEdit'
        ]);

        // 删除用户。
        Route::post('delete', [
            'as' => 'RootAdminDelete',
            'uses' => 'AdminController@postDelete'
        ]);
    });

    // 角色管理。
    Route::group([
        'prefix' => 'role'
    ], function () {

        // 角色列表。
        Route::get('list', [
            'as' => 'RootRoleList',
            'uses' => 'RoleController@getList'
        ]);

        // 角色编辑页。
        Route::get('edit', [
            'as' => 'RootRoleEdit',
            'uses' => 'RoleController@getEdit'
        ]);

        // 保存编辑。
        Route::post('save', [
            'as' => 'RootRoleEditAction',
            'uses' => 'RoleController@postEdit'
        ]);

        // 删除角色。
        Route::post('delete', [
            'as' => 'RootRoleDelete',
            'uses' => 'RoleController@postDelete'
        ]);
    });

    // 权限管理。
    Route::group([
        'prefix' => 'permission'
    ], function () {

        // 权限列表。
        Route::get('list', [
            'as' => 'RootPermissionList',
            'uses' => 'PermissionController@getList'
        ]);

        // 权限编辑页。
        Route::get('edit', [
            'as' => 'RootPermissionEdit',
            'uses' => 'PermissionController@getEdit'
        ]);

        // 保存编辑。
        Route::post('save', [
            'as' => 'RootPermissionEditAction',
            'uses' => 'PermissionController@postEdit'
        ]);

        // 删除权限。
        Route::post('delete', [
            'as' => 'RootPermissionDelete',
            'uses' => 'PermissionController@postDelete'
        ]);
    });
});

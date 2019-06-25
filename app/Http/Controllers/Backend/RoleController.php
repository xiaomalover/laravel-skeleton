<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * 角色管理
 * Class RoleController
 * @package App\Http\Controllers\Backend
 *
 * @author xiaomalover <xiaomalover@gmail.com>
 */
class RoleController extends Controller
{
    /**
     * 角色列表
     * @param Request $request
     * @return Factory|View
     */
    public function getList(Request $request)
    {
        // 取得数据模型。
        $model = Role::latest('id');

        // 附加筛选条件。
        foreach (['name', 'remark'] as $field) {
            if ($request->filled($field)) {
                $model->where($field, 'like', "%" . $request->input($field) . "%");
            }
        }

        // 取得单页数据。
        $data = $model->paginate($request->cookie('limit', 15));

        // 附加翻页参数。
        $data->appends($request->all());

        return view('backend.role.list', compact('data'));
    }

    /**
     * 编辑角色
     * @param Request $request
     * @return Factory|View
     */
    public function getEdit(Request $request)
    {
        // 取得要编辑的角色。
        $data = Role::find($request->input('id'));

        // 取得系统权限列表。
        $permissions = Permission::oldest('group')->oldest('key')->get();

        // 返回编辑视图。
        return view('backend.role.edit', compact('data', 'permissions'));
    }

    /**
     * 保存编辑
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function postEdit(Request $request)
    {
        // 验证输入。
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $request->input('id', 0),
            'permissions' => 'required|array|exists:permissions,key'
        ]);

        // 取得要编辑的模型。
        $data = $request->filled('id') ? Role::find($request->input('id')) : null;
        if (is_null($data)) {
            $data = new Role();
        }

        // 取得当前登陆用户。
        $user = Auth::guard('admin')->user();

        // 检查当前用户是否有编辑该角色的权限。
        if ($data->exists && !has_role($user, $data)) {
            abort(403);
        }

        // 编辑数据。
        $data->name = $request->name;
        $data->remark = $request->remark ?: '';
        $data->save();

        // 绑定权限列表。
        $data->permissions()->sync($request->permissions);

        // 返回成功信息。
        return redirect()->back()->withMessageSuccess(__('Successfully saved'));
    }

    /**
     * 删除角色
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function postDelete(Request $request)
    {
        // 验证输入。
        $this->validate($request, [
            'id' => 'required|exists:roles'
        ]);

        // 取得要删除的角色。
        $data = Role::find($request->input('id'));
        if ($data) {

            // 取得当前登陆用户。
            $user = Auth::guard('admin')->user();

            // 检查当前用户是否有编辑该角色的权限。
            if (!has_role($user, $data)) {
                abort(403);
            }

            // 删除角色。
            $data->delete();
        }

        // 返回成功信息。
        return redirect()->back()->withMessageSuccess(__('Successfully deleted'));
    }
}

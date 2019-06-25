<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * 权限管理
 * Class PermissionController
 * @package App\Http\Controllers\Backend
 *
 * @author xiaomalover <xiaomalover@gmail.com>
 */
class PermissionController extends Controller
{
    /**
     * 权限列表
     * @param Request $request
     * @return Factory|View
     */
    public function getList(Request $request)
    {
        // 取得数据模型。
        $model = Permission::oldest('key');

        // 附加筛选条件。
        foreach (['key', 'name', 'remark', 'group'] as $field) {
            if ($request->filled($field)) {
                $model->where($field, 'like', "%" . $request->input($field) . "%");
            }
        }

        // 取得单页数据。
        $data = $model->paginate($request->cookie('limit', 15));

        // 附加翻页参数。
        $data->appends($request->all());

        return view('backend.permission.list', compact('data'));
    }

    /**
     * 编辑权限
     * @param Request $request
     * @return Factory|View
     */
    public function getEdit(Request $request)
    {
        // 取得要编辑的权限。
        $data = Permission::find($request->input('key'));

        // 取得系统控制器列表。
        $routes = collect();
        foreach (Route::getRoutes() as $route) {
            $name = $route->getName();
            $middleware = (array)Arr::get($route->getAction(), 'middleware');
            if (!is_null($name) && in_array('permission:admin', $middleware)) {
                $route_name = trans('routes.' . $name);
                $route_name = preg_replace('/^routes\./', '', $route_name);
                $routes[$name] = $route_name;
            }
        }
        $routes = $routes->sort();

        // 返回编辑视图。
        return view('backend.permission.edit', compact('data', 'routes'));
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
            'key' => 'required',
            'name' => 'required',
            'actions' => 'required'
        ]);

        // 取得要编辑的模型。
        $data = Permission::firstOrNew([
            'key' => $request->input('key')
        ]);

        // 检查当前用户是否有编辑该操作的权限。
        foreach (collect($request->input('actions'))->merge($data->actions) as $action) {
            if (Auth::guard('admin')->user()->denies($action)) {
                abort(403);
            }
        }

        // 编辑数据。
        $data->name = $request->name;
        $data->group = $request->group ?: '';
        $data->remark = $request->remark ?: '';
        $data->actions = $request->actions;
        $data->save();

        // 返回成功信息。
        return redirect()->back()->withMessageSuccess(__('Successfully saved'));
    }

    /**
     * 删除权限
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function postDelete(Request $request)
    {
        // 验证输入。
        $this->validate($request, [
            'key' => 'required|exists:permissions'
        ]);

        // 取得要删除的权限。
        $data = Permission::find($request->input('key'));
        if ($data) {

            // 取得当前用户。
            $user = Auth::guard('admin')->user();

            // 检查当前用户是否有编辑该操作的权限。
            if (!has_permission($user, $data)) {
                abort(403);
            }

            // 删除权限。
            $data->delete();
        }

        // 返回成功信息。
        return redirect()->back()->withMessageSuccess(__('Successfully deleted'));
    }
}

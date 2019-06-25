<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * 账号信息
 *
 * @author
 *
 */
class ProfileController extends Controller
{

    /**
     * 修改密码
     */
    public function getChangePassword()
    {
        return view('backend.profile.change-password');
    }

    /**
     * 修改密码
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function postChangePassword(Request $request)
    {
        // 验证输入。
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|between:6,16'
        ]);

        // 取得当前用户。
        $user = Auth::guard('admin')->user();

        // 检查当前密码。
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->withErrors([
                'old_password' => __('Old password verification does not pass.')
            ]);
        }

        // 修改密码。
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // 强制退出。
        Auth::guard('admin')->logout();

        // 返回仪表盘。
        return redirect()->route('RootDashboard');
    }
}

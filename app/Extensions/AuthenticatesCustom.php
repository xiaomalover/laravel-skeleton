<?php

namespace App\Extensions;

use App\Models\Admin;
use Illuminate\Http\Request;


trait AuthenticatesCustom
{
    public function logout(Request $request)
    {
        if ($this->guard()->user() instanceof Admin) {
            $redirect_url = '/admin/login';
        } else {
            $redirect_url = '/';
        }

        $this->guard()->logout();

        $request->session()->forget($this->guard()->getName());

        $request->session()->regenerate();

        return redirect($redirect_url);
    }
}

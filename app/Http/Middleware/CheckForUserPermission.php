<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

/**
 * 检查用户权限
 *
 * @author  
 *
 */
class CheckForUserPermission
{

	/**
	 * Handle an incoming request.
	 *
	 * @param  Request  $request
	 * @param  Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null)
	{
		$user = Auth::guard($guard)->user();
		$route_name = Route::currentRouteName();
		if ($user->denies($route_name)) {
			Log::notice('Permission denied', [
				'user' => [
					'id' => $user->id,
					'username' => $user->username
				],
				'route_name' => $route_name
			]);
			abort(403);
		}

		return $next($request);
	}
}

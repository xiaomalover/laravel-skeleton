<?php

namespace App\Http\Middleware;

use Closure;


/**
 * 切换系统语言
 *
 * @author xiaomalover <xiaomalover@gmail.com>
 *
 */
class SwitchLanguage
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // 检查是否有设置语言的请求参数。
        $language = $request->input('language');
        if (!$language) {
            // 从Session取出语言配置。
            $language = $request->session()->get($guard . '.language');
        }

        // 若Session中没有语言，使用用户所在国家的语言。
        if (!$language) {
            $language = 'en';
        }

        // 尝试从用户浏览器中取得语言。
        if (!$language) {
            if (preg_match('/([a-z]{2})(?:-([a-z]{2}))?/i', (string)$request->header('accept-language'), $matches)) {
                $language = strtolower($matches[1]);
                if (isset($matches[2])) {
                    $language .= '-' . strtoupper($matches[2]);
                }
            }
        }

        // 若都没有语言配置，默认使用英语。
        if (!$language) {
            $language = 'en';
        }

        // 记录请求参数的语言设置到Session中。
        $request->session()->put($guard . '.language', $language);
        // 设置系统语言。
        app()->setLocale($language);
        return $next($request);
    }
}

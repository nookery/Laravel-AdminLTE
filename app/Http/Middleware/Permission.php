<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Permission as PermissionModel;
use Illuminate\Http\Request;

class Permission
{
    /**
     * 无需检查权限的路径
     *
     * @var array
     */
    protected $except = [
        'GET /',
        'POST logout',
        'GET login',
        'POST login'
    ];

    /**
     * 视图文件的路径
     *
     * @var
     */
    protected $view = 'errors.no-permission';

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!config('permission.enable_permission_checker')) {
            return $next($request);
        }

        $permissionName = $request->method().' '.$request->path();

        $permission = PermissionModel::query()->firstOrCreate([
            'name' => $permissionName,
            'guard_name' => 'web',
        ]);

        if (in_array($permissionName, $this->except)) {
            return $next($request);
        }

        if ($request->user()->cant($permission->name)) {
            return response()->view($this->view, [
                'message' => '无权访问：'.$permissionName
            ], 403);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Repositories\PermissionRepository;
use Closure;
use App\Models\Permission as PermissionModel;

class Permission
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository){
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permission = PermissionModel::query()->firstOrCreate([
            'name' => $request->method() . ' ' . $request->path(),
            'guard_name' => 'web',
        ]);

        if (!$request->user()->can($permission->name)) {
            return abort(403);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Repositories\Rbac\PermissionRepository;
use App\Repositories\Rbac\RoleRepository;
use App\Rules\Keyword;
use App\Rules\RoleName;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Prettus\Validator\Exceptions\ValidatorException;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $repository;

    protected $permissionRepository;

    public function __construct(RoleRepository $repository, PermissionRepository $permissionRepository)
    {
        $this->repository = $repository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * 展示
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function index(Request $request)
    {
        // 检查参数
        $request->validate([
            config('repository.criteria.params.search') => ['nullable', new Keyword()]
        ]);

        $items = $this->repository
            ->orderBy('id', 'desc')
            ->paginate(20);

        $permissions = $this->permissionRepository->all();

        return view('manage.roles')->with(compact('items', 'permissions', 'request'));
    }

    /**
     * 增加
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidatorException
     */
    public function create(Request $request)
    {
        // 检查参数
        $request->validate([
            'name' => ['required', 'unique:rbac_roles', new RoleName()],
        ]);

        $this->repository->create($request->all());

        return redirect('manage/roles');
    }

    /**
     * 更新
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request)
    {
        // 检查参数
        $request->validate([
            'id' => 'required|integer|min:1',
            'key' => 'required|string',
            'value' => 'required'
        ]);

        if ($request->input('key') === 'permissions') {
            $role = $this->repository->find($request->input('id'));
            $role->syncPermissions($request->input('value'));
        }

        return redirect('manage/roles');
    }
}

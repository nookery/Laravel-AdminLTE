<?php

namespace App\Http\Controllers\Manage;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Rules\UserEmail;
use App\Rules\UserName;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    protected $roleRepository;

    public function __construct(UserRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
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
        $validator = Validator::make($request->all(), [
            'keyword' => 'nullable|string|min:1|max:32'
        ]);

        if ($validator->fails()) {
            return redirect('manage/users')
                ->withErrors($validator)
                ->withInput();
        }

        $items = $this->repository
            ->search($request->input('keyword'))
            ->orderBy('id', 'desc')
            ->paginate(20);

        $roles = $this->roleRepository->all();

        return view('manage.users')->with(compact('items', 'roles', 'request'));
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
            'name' => ['required', 'unique:users', new UserName()],
            'email' => ['required', 'unique:users', new UserEmail()]
        ]);

        $this->repository->create($request->all());

        return redirect('manage/users');
    }

    /**
     * 删除
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function delete(Request $request)
    {
        // 检查参数
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect('manage/users')
                ->withErrors($validator)
                ->withInput();
        }

        $this->repository->delete($request->input('id'));

        return redirect('manage/users');
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

        if ($request->input('key') === 'roles') {
            $user = $this->repository->find($request->input('id'));
            $user->syncRoles($request->input('value'));
        }

        return redirect('manage/users');
    }
}

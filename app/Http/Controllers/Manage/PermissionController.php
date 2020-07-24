<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Repositories\Rbac\PermissionRepository;
use App\Rules\Keyword;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class PermissionController extends Controller
{
    /**
     * @var PermissionRepository
     */
    protected $repository;

    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
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
            'keyword' => ['nullable', new Keyword()]
        ]);

        $items = $this->repository
            ->search($request->input('keyword'))
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('manage.permissions')->with(compact('items', 'request'));
    }
}

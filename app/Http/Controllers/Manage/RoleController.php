<?php

namespace App\Http\Controllers\Manage;

use App\Repositories\LogRepository;
use App\Repositories\RoleRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * @var LogRepository
     */
    protected $repository;

    public function __construct(RoleRepository $repository){
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

        return view('manage.roles')->with(compact('items', 'request'));
    }
}

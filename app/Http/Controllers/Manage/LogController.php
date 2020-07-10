<?php

namespace App\Http\Controllers\Manage;

use App\Repositories\Auth\ActivityLogRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
{
    /**
     * @var ActivityLogRepository
     */
    protected $repository;

    public function __construct(ActivityLogRepository $repository){
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

        return view('manage.logs')->with(compact('items', 'request'));
    }
}

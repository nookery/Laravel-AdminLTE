<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * 展示所有的用户
     *
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        // 检查参数
        $validator = Validator::make($request->all(), [
            'realName' => 'nullable|string|min:1|max:32',
            'active' => Rule::in([null, 0, 1])
        ]);

        if ($validator->fails()) {
            return redirect('manage/users')
                ->withErrors($validator)
                ->withInput();
        }

        $builder = User::orderBy('id', 'desc');

        if ($request->realName) {
            $builder->where('real_name', 'like', "%{$request->realName}%");
        }
        if ($request->filled('active') ) {
            $builder->where('active', $request->input('active'));
        }

        $items = $builder->paginate(20);

        return view('manage.users')->with(compact('items', 'request'));
    }
}

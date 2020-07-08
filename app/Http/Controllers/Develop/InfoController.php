<?php

namespace App\Http\Controllers\Develop;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class InfoController extends Controller
{
    /**
     * 展示
     *
     * @return View
     */
    public function index()
    {
        return view('develop.info');
    }
}

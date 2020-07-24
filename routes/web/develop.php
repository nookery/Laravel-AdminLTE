<?php

use App\Http\Controllers\Develop\InfoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 开发模块的路由
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" and "permission_checker" middleware group. Now create something great!
|
| 注意：在 RouteServiceProvider 中配置了两个中间件：web,permission_checker
|
| Artisan命令 php artisan route:cache 可以将路由注册缩减到一个缓存文件中的单个方法调用，在注册数百个路由时能提高性能，
| 但是由于此功能使用 PHP 序列化，仅能缓存专门使用基于控制器路由的应用程序路由，不能序列化闭包路由。
| 所以如非特别必要，不要配置闭包路由。
|
*/

Route::group([
    'middleware' => ['auth:web'],
    'prefix'     => 'develop',
    'namespace'  => 'Develop'
], function () {
    // 系统信息
    Route::get('info', [InfoController::class, 'index']);
});

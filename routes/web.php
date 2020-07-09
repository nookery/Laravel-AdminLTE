<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| 开发模块
|--------------------------------------------------------------------------
|
*/

Route::group([
    'middleware' => ['auth:web'],
    'prefix'     => 'develop',
    'namespace'  => 'Develop'
], function () {
    // 系统信息
    Route::get('info', 'InfoController@index');
});

/*
|--------------------------------------------------------------------------
| 管理模块
|--------------------------------------------------------------------------
|
| 用户管理、角色管理、权限管理、操作日志等
|
*/

Route::group([
    'middleware' => ['auth:web'],
    'prefix'     => 'manage',
    'namespace'  => 'Manage'
], function () {
    /*
    |--------------------------------------------------------------------------
    | 用户管理
    |--------------------------------------------------------------------------
    */

    Route::group([
        'prefix' => 'users'
    ], function () {
        Route::get('', 'UserController@index');
        Route::post('', 'UserController@create');
        Route::delete('', 'UserController@delete');
        Route::get('delete', 'UserController@delete');
    });

    /*
    |--------------------------------------------------------------------------
    | 角色管理
    |--------------------------------------------------------------------------
    */

    Route::group([
        'prefix' => 'roles'
    ], function () {
        Route::get('', 'RoleController@index');
    });

    /*
    |--------------------------------------------------------------------------
    | 权限管理
    |--------------------------------------------------------------------------
    */

    Route::group([
        'prefix' => 'permissions'
    ], function () {
        Route::get('', 'PermissionController@index');
    });

    /*
    |--------------------------------------------------------------------------
    | 日志管理
    |--------------------------------------------------------------------------
    */

    Route::group([
        'prefix' => 'logs'
    ], function () {
        Route::get('', 'LogController@index');
    });
});

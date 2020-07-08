<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('clear', function () {
    $this->info('开始清理页面缓存');
    Artisan::call('view:clear');
    $this->info('开始清理配置缓存');
    Artisan::call('config:clear');
    $this->info('开始清理其他缓存');
    Artisan::call('cache:clear');
    $this->info('完成');
})->describe('清理一切缓存');

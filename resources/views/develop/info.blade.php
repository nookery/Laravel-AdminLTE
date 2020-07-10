@extends('layouts.basic')

@section('content_body')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bullhorn"></i>
                        系统信息
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="callout callout-info">
                        <h5>Laravel版本</h5>

                        <p>{{ app()->version() }}</p>
                    </div>
                    <div class="callout callout-info">
                        <h5>权限系统</h5>

                        <p>{{ config('APP_CHECK_PERMISSION') ? '开启' : '关闭' }}</p>
                    </div>
                    <div class="callout callout-info">
                        <h5>调试模式</h5>

                        <p>{{ config('app.debug') ? '开启' : '关闭' }}</p>
                    </div>
                    <div class="callout callout-info">
                        <h5>环境</h5>

                        <p>{{ config('app.env') }}</p>
                    </div>
                    <div class="callout callout-info">
                        <h5>时区</h5>

                        <p>{{ config('app.timezone') }}</p>
                    </div>
                    <div class="callout callout-info">
                        <h5>区域</h5>

                        <p>{{ config('app.locale') }}</p>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bullhorn"></i>
                        PHP信息
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="callout callout-info">
                        <h5>PHP版本</h5>

                        <p>{{ PHP_VERSION }}</p>
                    </div>
                    <div class="callout callout-info">
                        <h5>PHP扩展</h5>
                        <div class="row">
                            @forelse (get_loaded_extensions() as $extension)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" checked disabled>
                                            <label class="form-check-label">{{ $extension }}</label>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@stop


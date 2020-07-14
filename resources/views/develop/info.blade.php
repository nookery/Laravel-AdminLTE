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
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" {{ extension_loaded('redis') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Redis</label>
                                        <p>Horizon队列管理组件会用到此扩展</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" {{ extension_loaded('pcntl') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Pcntl</label>
                                        <p>Horizon队列管理组件会用到此扩展</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" {{ extension_loaded('openssl') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">openssl</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" {{ extension_loaded('pdo') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">pdo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" {{ extension_loaded('mbstring') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">mbstring</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" {{ extension_loaded('tokenizer') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">tokenizer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" {{ extension_loaded('JSON') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">JSON</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" {{ extension_loaded('cURL') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">cURL</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="callout callout-info">
                        <h5>其他变量</h5>
                        
                        <p>REMOTE_ADDR：{{ $_SERVER['REMOTE_ADDR'] }}</p>
                        <p>SERVER_PROTOCOL：{{ $_SERVER['SERVER_PROTOCOL'] }}</p>
                        <p>PATH_INFO：{{ $_SERVER['PATH_INFO'] }}</p>
                        <p>PHP_SELF：{{ $_SERVER['PHP_SELF'] }}</p>
                        <p>HTTP_HOST：{{ $_SERVER['HTTP_HOST'] }}</p>
                        <p>HTTP_REFERER：{{ $_SERVER['HTTP_REFERER'] }}</p>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@stop


@extends('layouts.basic')

@section('content_body')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        日志管理
                    </h3>

                    <div class="card-tools">
                        <form action="{{ url()->current() }}" class="form-inline" data-pjax>
                            <div class="input-group input-group-sm" style="width: 350px;">
                                <input type="text" name="keyword" class="form-control float-right" placeholder="输入关键字查询"
                                       value="{{ request()->input('keyword') }}" style="color: red">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body collapse" id="add-form">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">添加用户</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url()->current() }}" method="post" data-pjax>
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">用户名</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="输入用户名">
                                </div>
                                <div class="form-group">
                                    <label for="email">邮箱</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="输入邮箱">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="输入密码">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body table-hover table-responsive p-0" style="height: 600px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>类型</th>
                            <th>描述</th>
                            <th>变动者</th>
                            <th>触发者</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->log_name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->subject_type }}</td>
                                    <td>{{ $item->causer_type }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" align="center">没有记录</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer clearfix" data-pjax="true">
                    <div class="float-right">{{ $items->appends(request()->all())->links() }}</div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop


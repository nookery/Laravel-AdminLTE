@extends('layouts.basic')

@section('content_body')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        用户管理
                    </h3>

                    <div class="card-tools">
                        <form action="{{ url()->current() }}" class="form-inline" data-pjax>
                            <div class="input-group input-group-sm" style="width: 350px;">
                                <input type="text" name="keyword" class="form-control float-right" placeholder="输入关键字查询"
                                       value="{{ request()->input('keyword') }}" style="color: red">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>

                                <div class="input-group-append">
                                    <button type="button" class="btn btn-block btn-default" data-toggle="collapse" href="#add-form">增加</button>
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
                        <form role="form" id="quickForm" action="{{ url()->current() }}" method="post" data-ajaxSubmit>
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">用户名</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="输入用户名">
                                </div>
                                <div class="form-group">
                                    <label for="email">邮箱</label>
                                    <input type="text" name="email" class="form-control" id="email" placeholder="输入邮箱">
                                </div>
                                <div class="form-group">
                                    <label for="password">密码</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="输入密码">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input" id="terms" checked="true">
                                        <label class="custom-control-label" for="terms">已阅读并同意 <a href="#">用户协议</a></label>
                                    </div>
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
                            <th>用户名</th>
                            <th>邮件</th>
                            <th>角色</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    {{ json_encode($item->getRoleNames()) }}
                                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-default">
                                        编辑
                                    </button>
                                    <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Default Modal</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>One fine body…</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="#">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ url('manage/users/delete?id='.$item->id) }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        删除
                                    </a>
                                </td>
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


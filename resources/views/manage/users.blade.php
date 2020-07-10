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
                                       value="{{ request()->input('keyword') ?? request()->old('keyword') }}" style="color: red">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>

                                <div class="input-group-append">
                                    <button type="button" class="btn btn-block btn-default" data-toggle="collapse" href="#add-card">增加</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body collapse" id="add-card">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">添加用户</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="add-form" action="{{ url()->current() }}" method="post" data-ajaxSubmit>
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
                                    {{ implode(' ', $item->getRoleNames()->toArray()) }}
                                    <div class="modal fade" id="modal-default{{ $item->id }}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">角色配置</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card card-secondary">
                                                        <div class="card-body">
                                                            <form role="form" action="{{ url()->current() }}" method="POST" data-ajaxSubmit>
                                                                <input type="hidden" name="key" value="roles">
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <!-- checkbox -->
                                                                <div class="form-group">
                                                                    @foreach ($roles as $role)
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input class="custom-control-input" name="value[]" type="checkbox" id="{{ $item->id.$role->id }}" value="{{ $role->name }}"
                                                                        {{ $item->hasRole($role->name) ? 'checked' : '' }}>
                                                                        <label for="{{ $item->id.$role->id }}" class="custom-control-label">{{ $role->name }}</label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>

                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary">保存</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <td class="project-actions text-middle">
                                    <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#modal-default{{ $item->id }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        角色
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


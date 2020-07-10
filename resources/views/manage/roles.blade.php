@extends('layouts.basic')

@section('content_body')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        角色管理
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
                            <h3 class="card-title">添加角色</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="add-form" action="{{ url()->current() }}" method="post" data-ajaxSubmit>
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">角色名</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="输入角色名">
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
                            <th>名称</th>
                            <th>guard</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->guard_name }}</td>
                                    <td>
                                        <div class="modal fade" id="modal-default{{ $item->id }}" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">权限配置</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card card-secondary">
                                                            <div class="card-body">
                                                                <form role="form" action="{{ url()->current() }}" method="POST" data-ajaxSubmit>
                                                                    <input type="hidden" name="key" value="permissions">
                                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <!-- checkbox -->
                                                                    <div class="form-group">
                                                                        @foreach ($permissions as $permission)
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input class="custom-control-input" name="value[]" type="checkbox" id="{{ $item->id.$permission->id }}" value="{{ $permission->name }}"
                                                                                    {{ $item->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                                                <label for="{{ $item->id.$permission->id }}" class="custom-control-label">{{ $permission->name }}</label>
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
                                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#modal-default{{ $item->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            权限
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


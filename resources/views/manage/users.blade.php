@extends('layouts.basic')

@section('title', 'Dashboard')

@section('content_header')
    <h1>用户管理</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fixed Header Table</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 600px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>实名</th>
                            <th>邮件</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    <a tabindex="0" class="btn btn-xs btn-default btn-popover-html"
                                       data-toggle="popover" data-placement="right"
                                       data-content="创建于：{{ $item->created_at }}<br>更新于：{{ $item->updated_at }}">
                                        {{ $item->id }}
                                    </a>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a class="editable" href="#" data-type="text" data-pk="{{ $item->id }}"
                                       data-url="{{ url('/manage/users/'.$item->id) }}" data-placement="bottom"
                                       data-title="输入实名" data-name="real_name">{{ $item->real_name }}</a>
                                </td>
                                <td>
                                    <a class="editable" href="#" data-type="text" data-pk="{{ $item->id }}"
                                       data-url="{{ url('/manage/users/'.$item->id) }}" data-placement="left"
                                       data-title="输入邮件" data-name="email">{{ $item->email }}</a>
                                </td>
                                <td>
                                    <a class="editable-select label" href="#" data-type="select" data-pk="{{ $item->id }}"
                                       data-url="{{ url('/manage/users/'.$item->id) }}"
                                       data-source="[{value:0,text:'冻结'},{value:1,text:'正常'}]"
                                       data-name="active" data-title="选择状态" data-placement="left"
                                       data-classes="[{value:0,class:'label-danger'},{value:1,class:'label-success'}]"
                                       data-value="{{ $item->active }}">{{ $item->active }}
                                    </a>
                                </td>
                                <td>
                                    <a class="editable btn btn-xs" href="#" data-type="text" data-placement="left"
                                       data-pk="{{ $item->id }}" data-url="{{ url('/manage/users/'.$item->id) }}"
                                       data-title="输入新密码" data-name="password">重设密码</a>
                                    <a class="btn btn-xs not-pjax" href="{{ url('/manage/users/navigators?user_id='.$item->id) }}">导航配置</a>
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

                <div class="card-footer clearfix">
                    <div class="float-right">{{ $items->links() }}</div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@extends('layouts.table-responsive')

@section('title', 'Dashboard')

@section('content_header')
    <h1>用户管理</h1>
@stop

@section('table-head')
    <th>ID</th>
    <th>用户名</th>
    <th>实名</th>
    <th>邮件</th>
    <th>状态</th>
    <th>操作</th>
@stop

@section('table-body')
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
@stop

@extends('layouts.table-responsive')

@section('title', 'Dashboard')

@section('content_header')
    <h1>用户管理</h1>
@stop

@section('table-head')
    <th>ID</th>
    <th>用户名</th>
    <th>邮件</th>
    <th>操作</th>
@stop

@section('table-body')
    @forelse ($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
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

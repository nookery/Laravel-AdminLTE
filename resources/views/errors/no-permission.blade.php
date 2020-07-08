@extends('layouts.basic')

@section('content_body')
    <div class="error-page">
        <h2 class="headline text-warning"> 403</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> {{ $message }}</h3>

            <p><a href="{{ url('/') }}">返回首页</a></p>
        </div>
        <!-- /.error-content -->
    </div>
@stop

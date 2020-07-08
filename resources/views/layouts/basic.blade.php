@extends('adminlte::page')

@section('content')
    <div id="pjax-container">
        @yield('content_body')
    </div>
@stop

@section('js')
    <script>
        $(document).pjax('a[data-pjax=true]', '#pjax-container');
    </script>
@stop


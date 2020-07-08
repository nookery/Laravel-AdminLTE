@extends('adminlte::page')

@section('content')
    <div id="pjax-container">
        @yield('content_body')
    </div>
@stop

@section('js')
    <script>
        $(document).pjax('a[data-pjax], [data-pjax] a', '#pjax-container');

        $(document).on('submit', 'form[data-pjax]', function(event) {
            $.pjax.submit(event, '#pjax-container');
            console.log(event)
        })
    </script>
@stop


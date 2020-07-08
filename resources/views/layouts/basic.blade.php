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

        /*
        |--------------------------------------------------------------------------
        | 点击一个pjax的链接后，尝试加上active，并移除其他元素的active
        |--------------------------------------------------------------------------
        */
        $(document).on('click', 'a[data-pjax]', function () {
            let link = $(this).attr('href');
            let sidebar = $('aside.main-sidebar');

            // 如果被点击的节点是在左侧的sidebar内
            if ($(this).parents('aside.main-sidebar').length > 0) {
                // 所有元素移除激活
                $('aside.main-sidebar .active').removeClass('active');

                // 闭合已经展开的其他导航
                $('aside.main-sidebar .menu-open').each(function () {
                    $(this).removeClass('menu-open');
                    $(this).find('ul.treeview-menu').hide();
                });

                // // 激活当前元素
                $(this).addClass('active');
                // $(this).parents().addClass('active');
                $(this).parents('ul.nav-treeview').show();
                $(this).parents('li.has-treeview').addClass('menu-open');
                $(this).parents('li.has-treeview').find('a:first').addClass('active');
            }

            // 如果被点击的节点是在pjax-container内
            if ($(this).parents('#pjax-container').length > 0) {
                console.log('#pjax-container内的data-pjax被点击');

                // 所有元素移除激活
                $('#pjax-container .active').removeClass('active');

                // 激活当前元素
                $(this).addClass('active');
                $(this).parent('li').addClass('active');
            }

            // 激活当前元素的父节点
            parent = $(this).parent();
            if (parent.siblings('.active').length > 0) {
                parent.addClass('active');
                parent.siblings('.active').removeClass('active');
            }

            // 兄弟节点及兄弟节点的子节点移除激活
            $(this).siblings().removeClass('active');
            $(this).siblings().find('.active').removeClass('active');
        });
    </script>
@stop


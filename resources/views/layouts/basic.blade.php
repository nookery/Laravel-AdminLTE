@extends('adminlte::page')

@section('right-sidebar')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ url('horizon') }}" class="nav-link" target="_blank">
                <i class="far fa-circle nav-icon"></i>
                <p>Horizon</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('telescope') }}" class="nav-link" target="_blank">
                <i class="far fa-circle nav-icon"></i>
                <p>Telescope</p>
            </a>
        </li>
    </ul>
@stop

@section('content')
    <div id="pjax-container">
        @yield('content_body')
    </div>
@stop

@section('js')
    <script>
        $(document).pjax('a[data-pjax], [data-pjax] a', '#pjax-container');

        $(document).on('submit', 'form[data-pjax]', function(event) {
            $.pjax.submit(event, '#pjax-container', {
                dataType: 'html' // 要求服务端返回的格式，默认html
            });
        });

        $(document).on('pjax:complete', function () {
            initialize()
        });

        function initialize() {
            $('#add-form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        }

        $(function() {
            initialize()
        });

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

        /*
        |--------------------------------------------------------------------------
        | 通过ajax提交表单
        |--------------------------------------------------------------------------
        */
        $(document).on('submit', 'form[data-ajaxSubmit]', function (event) {
            const form = event.currentTarget;
            var button = $(form).find('button[type=submit]:first');
            const title = button.html();

            if (button.attr('disabled')) {
                return false;
            }

            button.attr('disabled', 'true');
            button.html('');
            button.html('处理中');

            console.log('开始了')

            $(form).ajaxSubmit({
                async: true,
                success: function (response) {
                    window.location.reload();
                },
                error: function (xhr, status, err) {
                    $(form).validate().showErrors(xhr.responseJSON.errors);
                    button.removeAttr('disabled').html(title);
                }
            })

            console.log('结束了')

            event.preventDefault();
        });
    </script>
@stop


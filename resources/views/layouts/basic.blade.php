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
                dataType: 'json' // 要求服务端返回的格式，默认html
            });
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

        /*
        |--------------------------------------------------------------------------
        | 通过ajax提交表单
        |--------------------------------------------------------------------------
        */
        $(document).on('submit', 'form[data-ajaxSubmit]', function (event) {
            const form = event.currentTarget;
            const button = $(form).find('button[type=submit]');
            const title = button.html();

            if (button.attr('disabled')) {
                return false;
            }

            button.attr('disabled', 'true');
            button.html('处理中');

            $(form).ajaxSubmit({
                async: false,
                success: function (response) {
                    if (0 > response.code) {
                        alertFormError.find('span.content:first').html(response.reason);
                        alertFormError.show();
                    } else {
                        layer.msg(response.reason,{icon:0,shade:0.3,shadeClose:true});
                        if (response.result) {
                            alertFormInfo.find('span.content:first').html(response.reason + response.result);
                            alertFormInfo.show();
                        }
                        if (me.attr('data-reload-after-submit') && me.attr('data-reload-after-submit').toString() === 'true') {
                            window.location.reload();
                        }
                    }
                },
                error: function (xhr, status, err) {
                    $(form).validate().showErrors(xhr.responseJSON.errors);
                }
            })

            button.removeAttr('disabled').html(title);

            event.preventDefault();
        });

        /*
        |--------------------------------------------------------------------------
        | 发生变动时，提交表单
        |--------------------------------------------------------------------------
        */
        $(document).on('change', '.submit-on-change', function () {
            $(this).parents('form:first').submit();
        });

        /*
        |--------------------------------------------------------------------------
        | 点击后下载
        | 服务端可能直接返回了文件，也可能返回了文件的下载地址
        |--------------------------------------------------------------------------
        */
        $(document).on('click', '.download', function () {
            // 尝试从属性中获取URL
            let url = $(this).attr('data-url');
            if (!url) {
                url = $(this).attr('data-link');
            }

            // 尝试根据表单合成URL
            let form = $(this).parents('form').first();
            if (!url && form.length > 0) {
                url = form[0].action > 0 ? form[0].action : window.location.href;
                let a = $('<a>', {href:url});
                url = a.prop('pathname') + '?' + form.serialize();
            }

            // 必须获取正确的下载地址
            if (url.length <= 0) {
                layer.alert('无法获取下载链接，请联系开发者调试代码');
                return false;
            }

            // 解析URL，URL中增加download=true&export=true
            let a = $('<a>', {href: url});
            if (a.prop('search')) {
                url = url.replace('?', '?download=true&export=true&');
            } else {
                url = url + '?download=true&export=true';
            }

            let me = $(this);
            let html = me.html();
            let disabled = me.attr('disabled');
            let confirmTitle = $(this).attr('data-confirm-title');

            // 显示表单错误信息的alert
            let alertFormError = $('.alert-form-error');
            if (alertFormError.length > 0) {
                alertFormError.find('ul li').remove();
            }

            if (disabled) {
                layer.msg('正在处理，不要重复点击');
                return false;
            } else {
                me.html('处理中').attr('disabled', 'true');
            }

            if (confirmTitle) {
                layer.confirm(confirmTitle, {
                    title: false,
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    layer.closeAll();
                    download();
                }, function () {
                    layer.msg('已取消');
                    me.html(html).removeAttr('disabled');
                });
            } else {
                download();
            }

            function download() {
                $.ajax({
                    async: true,
                    type: "get",
                    url: url,
                    complete: function () {
                        me.html(html).removeAttr('disabled');
                    },
                    success: function (response, textStatus, request) {
                        let contentType = request.getResponseHeader('Content-Type');
                        if (contentType.toString() === 'application/json') {
                            // 返回的json中是否包含了实际的下载链接
                            if (response.hasOwnProperty('result') && response.result.hasOwnProperty('link')) {
                                window.location = response.result.link;
                            } else {
                                // 否则，显示错误，优先在页面显示错误，或弹窗
                                if (alertFormError.length > 0) {
                                    if (response.result) {
                                        alertFormError.find('ul').append('<li>' + response.reason + '->' + response.result + '</li>');
                                    } else {
                                        alertFormError.find('ul').append('<li>' + response.reason + '</li>');
                                    }
                                    alertFormError.show();
                                } else {
                                    layer.alert(response.reason);
                                }
                            }
                        } else {
                            alertFormError.hide();
                            // 返回的不是json，认为是文件，直接跳转并下载
                            window.location = url;
                        }
                    }
                });
            }
        });

        $(document).ready(function () {
            // $.validator.setDefaults({
            //     submitHandler: function () {
            //         alert( "Form successful submitted!" );
            //     }
            // });

            $('#quickForm').validate({
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
        });
    </script>
@stop


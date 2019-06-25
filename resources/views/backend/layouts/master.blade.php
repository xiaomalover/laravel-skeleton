<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"> -->
    <link href="{{ asset('slicklab/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!--right slidebar-->
    <link href="{{ asset('slicklab/css/slidebars.css') }}" rel="stylesheet">
    <!--switchery-->
    <link href="{{ asset('slicklab/js/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css"
          media="screen"/>

    @stack('head')

<!--common style-->
    <link href="{{ asset('slicklab/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('slicklab/css/style-responsive.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="{{ asset('slicklab/js/jquery-1.10.2.min.js') }}"></script>
    <script src="{{ asset('slicklab/js/template.js') }}"></script>
<!--script src="{{ asset('js/vue.min.js') }}"></script -->
</head>

<body class="sticky-header @if (@$_COOKIE['sidebar_collapsed'])sidebar-collapsed @endif">

<section>
    <!-- sidebar left start-->
@include('backend.layouts.sidebar-menu')
<!-- sidebar left end-->

    <!-- body content start-->
    <div class="body-content">

        <!-- header section start-->
        <div class="header-section">

            <!--logo and logo icon start-->
            <div class="logo theme-logo-bg hidden-xs hidden-sm">
                <a href="{{ route('RootDashboard') }}">
                    <img src="{{ asset('slicklab/img/logo.png') }}" width="32" height="32" alt="">
                    <!--<i class="fa fa-maxcdn"></i>-->
                    <span class="brand-name">{{__("Backend System")}}</span>
                </a>
            </div>

            <div class="icon-logo theme-logo-bg hidden-xs hidden-sm">
                <a href="{{ route('RootDashboard') }}">
                    <img src="{{ asset('slicklab/img/logo.png') }}" width="32" height="32" alt="">
                    <!--<i class="fa fa-maxcdn"></i>-->
                </a>
            </div>
            <!--logo and logo icon end-->

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
            <!--toggle button end-->

            <div class="navbar-collapse collapse yamm mega-menu">
                <ul class="nav navbar-nav">
                    <!-- Classic dropdown -->
                    <li class="dropdown"><a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle">
                            @if(session('admin.language') == 'en')
                                English
                            @elseif(session('admin.language') == 'zh-CN')
                                简体中文
                            @else
                                {{ __('Select Language') }}
                            @endif
                            <b class=" fa fa-angle-down"></b></a>
                        <ul role="menu" class="dropdown-menu language-switch">
                            <li>
                                <a href="{{ route(Route::currentRouteName(), array_merge(Request::all(), [ 'language' => 'zh-CN' ])) }}"><span> 简体中文 </span><img
                                            src="/slicklab/img/flags/cn.png" alt=""></a>
                            </li>
                            <li>
                                <a href="{{ route(Route::currentRouteName(), array_merge(Request::all(), [ 'language' => 'en' ])) }}"><span> English </span>
                                    <img src="/slicklab/img/flags/us.png" alt=""></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="notification-wrap">

                <!--right notification start-->

                <div class="right-notification">
                    <ul class="notification-menu">

                        <li>
                            <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="/slicklab/img/avatar-mini.jpg" alt="">{{ auth('admin')->user()->username }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                                @if(! auth('admin')->user()->denies('RootChangePassword'))
                                    <li><a href="{{ route('RootChangePassword') }}">{{__('Change Password')}}</a></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ url('admin/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out pull-right"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('admin/logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--right notification end-->
            </div>

        </div>
        <!-- header section end-->

        <!-- page head start-->
        <div class="page-head">
            <h3>@yield('title')</h3>
            <span class="sub-title">@yield('small-title')</span>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="{{ route('RootDashboard') }}">{{__('Dashboard')}}</a></li>
                    @yield('breadcrumb')
                </ol>
            </div>
            <script>
                // 固定左侧滑动菜单。
                var breadcrumb = [], minMenu = null;
                $('.breadcrumb a[href]').each(function () {
                    breadcrumb.unshift(this.href);
                });
                $('.sidebar-left a[href]').each(function () {
                    for (var i in breadcrumb) {
                        if (this.href == breadcrumb[i]) {
                            if (minMenu === null || i < minMenu) {
                                minMenu = i;
                            }
                            $(this).attr('priority', i);
                            return;
                        }
                    }
                });
                var menu = $('.sidebar-left a[priority="' + minMenu + '"]:first');
                menu.parent().addClass('active').parents('.child-list').css('display', '')
                    .parents('.menu-list').addClass('nav-active');
            </script>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">
            @include('backend.layouts.message')
            @yield('main')
        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <footer>
            @php
                $copy_date = 2017;
                if(date('Y') != $copy_date){
                    $copy_date .= '-' . date('Y');
                }
            @endphp
            Copyright &copy; {{ $copy_date }} Xiaomalover, All Rights Reserved
        </footer>
        <!--footer section end-->

    </div>
    <!-- body content end-->
</section>

<div id="alertModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="alertModalLabel">{{__('Message')}}</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" type="button">{{__('Ok')}}</button>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
     aria-hidden="true">
    <form method="POST" class="modal-dialog" role="document" id="confirmModalForm">
        <input id="confirmTitle" value="{{__('Confirm Operation')}}" type="hidden"/>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="confirmModalLabel"></h4>
            </div>
            <div class="modal-body" style="white-space: pre-wrap; word-break: break-all;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Cancel')}}</button>
                <button type="button" class="btn btn-warning" data-primary="true">{{__('Ok')}} <span
                            class="fa fa-external-link" style="display: none;"></span></button>
            </div>
        </div>
    </form>
</div>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="{{ asset('slicklab/js/jquery.cookies.js') }}"></script>
<script src="{{ asset('slicklab/js/jquery-migrate.js') }}"></script>
<script src="{{ asset('slicklab/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('slicklab/js/modernizr.min.js') }}"></script>

<!--Nice Scroll-->
<script src="{{ asset('slicklab/js/jquery.nicescroll.js') }}" type="text/javascript"></script>

<!--right slidebar-->
<script src="{{ asset('slicklab/js/slidebars.min.js') }}"></script>

<!--switchery-->
<script src="{{ asset('slicklab/js/switchery/switchery.min.js') }}"></script>
<script src="{{ asset('slicklab/js/switchery/switchery-init.js') }}"></script>

<!--Sparkline Chart-->
<script src="{{ asset('slicklab/js/sparkline/jquery.sparkline.js') }}"></script>
<script src="{{ asset('slicklab/js/sparkline/sparkline-init.js') }}"></script>

<!--common scripts for all pages-->
<script src="{{ asset('slicklab/js/common.js') }}"></script>
<script src="{{ asset('slicklab/js/scripts.js') }}"></script>

@stack('script')

@if(Session::has('errors'))
    <script>
        (function () {
            var $errors = {};

            @foreach(Session::get('errors')->getMessages() as $field => $messages)
                $errors['{{ $field }}'] = {
                elem: $(':input[name="{{ $field }}"], :input[name="{{ $field }}[]"], :input[name="data[{{ $field }}]"], :input[name="data[{{ $field }}][]"]').parents('.form-group').addClass('has-error').find('> div:last'),
                messages: {!! json_encode($messages) !!}
            };
                    @endforeach

            var messages = [];
            for (var field in $errors) {
                if ($errors[field].elem.length) {
                    for (var i in $errors[field].messages) {
                        $errors[field].elem.append('<span class="help-block">' + $errors[field].messages[i] + '</span>');
                    }
                } else {
                    messages = messages.concat($errors[field].messages);
                }
            }
            if (messages.length) {
                $('.wrapper').prepend('\
					<div class="alert alert-danger alert-dismissible" role="alert">\
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
						' + messages.shift() + '\
					</div>');
            }

            $('.has-error :input:first').focus();
        })();
    </script>
@endif

</body>
</html>
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>@yield('title')</title>

    <!--right slidebar-->
    <link href="{{ asset('slicklab/css/slidebars.css') }}" rel="stylesheet">

    <!--switchery-->
    <link href="{{ asset('slicklab/js/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css"
          media="screen"/>

    @stack('head')

    <!--common style-->
    <link href="{{ asset('slicklab/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('slicklab/css/style-responsive.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('slicklab/js/html5shiv.js') }}"></script>
    <script src="{{ asset('slicklab/js/respond.min.js') }}"></script>
    <![endif]-->

    <script src="{{ asset('slicklab/js/jquery-1.10.2.min.js') }}"></script>
    <script src="{{ asset('slicklab/js/template.js') }}"></script>
</head>

@if (@$_COOKIE['boxed'])
    <body class="@if (@$_COOKIE['sidebar_collapsed'])sidebar-collapsed @endif boxed-view" style="">
@else
    <body class="sticky-header @if (@$_COOKIE['sidebar_collapsed'])sidebar-collapsed @endif" style="">
@endif

<section>
    <div class="@if (@$_COOKIE['boxed'])container @endif" id="container">
        <!-- sidebar left start-->
        <div class="sidebar-left">
            <!--responsive view logo start-->
            <div  class="logo dark-logo-bg visible-xs-* visible-sm-*">
                <a href="{{ route('RootDashboard') }}">
                    <img src="/slicklab/img/logo-icon.png" alt="">
                    <!--<i class="fa fa-maxcdn"></i>-->
                    <span class="brand-name">{{__("Backend System")}}</span>
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
                <div class=" search-field"></div>
                <!-- visible small devices end-->

                <!--sidebar nav start-->
                @include('backend.layouts.sidebar-left')
                <!--sidebar nav end-->

                <!--sidebar widget start-->
            {{--<div class="sidebar-widget">
                <h4>Server Status</h4>
                <ul class="list-group">
                    <li>
                        <span class="label label-danger pull-right">33%</span>
                        <p>CPU Used</p>
                        <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-danger" style="width: 33%;">
                                <span class="sr-only">33%</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <span class="label label-warning pull-right">65%</span>
                        <p>Bandwidth</p>
                        <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-warning" style="width: 65%;">
                                <span class="sr-only">65%</span>
                            </div>
                        </div>
                    </li>
                    <li><a href="javascript:;" class="btn btn-success btn-sm ">View Details</a></li>
                </ul>
            </div>--}}
            <!--sidebar widget end-->

            </div>
        </div>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1100px;">

            <!-- header section start-->
            <div class="header-section">

                <!--logo and logo icon start-->
                <div class="logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="{{ route('RootDashboard') }}">
                        <img src="/slicklab/img/logo-icon.png" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                        <span class="brand-name">{{__("Backend System")}}</span>
                    </a>
                </div>

                <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="{{ route('RootDashboard') }}">
                        <img src="/slicklab/img/logo-icon.png" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                    </a>
                </div>
                <!--logo and logo icon end-->

                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
                <!--toggle button end-->

                <!--language button start-->
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
                <!--language button end-->

                <div class="notification-wrap">
                    <!--left notification start-->
                {{--<div class="left-notification">
                    <ul class="notification-menu">
                        <!--mail info start-->
                        <li class="d-none">
                            <a href="javascript:;" class="btn btn-default dropdown-toggle info-number"
                               data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-primary">6</span>
                            </a>

                            <div class="dropdown-menu dropdown-title">
                                <div class="title-row">
                                    <h5 class="title purple">
                                        You have 6 Unread Mail
                                    </h5>
                                    <a href="javascript:;" class="btn-primary btn-view-all">View all</a>
                                </div>
                                <div class="notification-list mail-list">
                                    <a href="javascript:;" class="single-mail">
                            <span class="icon bg-primary">
S
                            </span>
                                        <strong>Smith Doe</strong>
                                        <small> Just Now</small>
                                        <p>
                                            <small>Hello smith i have some query about your</small>
                                        </p>
                                        <span class="un-read tooltips" data-original-title="Mark as Read"
                                              data-toggle="tooltip" data-placement="left">
                                <i class="fa fa-circle"></i>
                            </span>
                                    </a>
                                    <a href="javascript:;" class="single-mail">
                            <span class="icon bg-success">
A
                            </span>
                                        <strong>Anthony Jones </strong>
                                        <small> 30 Mins Ago</small>
                                        <p>
                                            <small>Hello this is an example message</small>
                                        </p>
                                        <span class="un-read tooltips" data-original-title="Mark as Read"
                                              data-toggle="tooltip" data-placement="left">
                                <i class="fa fa-circle"></i>
                            </span>
                                    </a>
                                    <a href="javascript:;" class="single-mail">
                            <span class="icon bg-warning">
B
                            </span> Billy Jones
                                        <small> 2 Days Ago</small>
                                        <p>
                                            <small>Slicklab is awesome Dashboard</small>
                                        </p>
                                        <span class="read tooltips" data-original-title="Mark as Unread"
                                              data-toggle="tooltip" data-placement="left">
                                <i class="fa fa-circle-o"></i>
                            </span>
                                    </a>
                                    <a href="javascript:;" class="single-mail">
                            <span class="icon bg-dark">
J
                            </span> John Doe
                                        <small> 1 Week Ago</small>
                                        <p>
                                            <small>Build with Twitter Bootstrap 3</small>
                                        </p>
                                        <span class="read tooltips" data-original-title="Mark as Unread"
                                              data-toggle="tooltip" data-placement="left">
                                <i class="fa fa-circle-o"></i>
                            </span>
                                    </a>
                                    <a href="javascript:;" class="single-mail">
                            <span class="icon bg-danger">
S
                            </span> Smith Doe
                                        <small> Just Now</small>
                                        <p>
                                            <small>No hassle, very easy to use</small>
                                        </p>
                                        <span class="read tooltips" data-original-title="Mark as Unread"
                                              data-toggle="tooltip" data-placement="left">
                                <i class="fa fa-circle-o"></i>
                            </span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!--mail info end-->

                        <!--task info start-->
                        <li class="d-none">
                            <a href="javascript:;" class="btn btn-default dropdown-toggle info-number"
                               data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="badge bg-success">9</span>
                            </a>

                            <div class="dropdown-menu dropdown-title">
                                <div class="title-row">
                                    <h5 class="title green">
                                        You have 9 task
                                    </h5>
                                    <a href="javascript:;" class="btn-success btn-view-all">View all</a>
                                </div>
                                <div class="notification-list task-list">
                                    <a href="javascript:;">
                            <span class="icon ">
                                <i class="fa fa-paw green-color"></i>
                            </span>
                                        <span class="task-info">
Smith Doe
<small> Assigned new task 10 min ago</small>
                                </span>
                                    </a>
                                    <a href="javascript:;">
                            <span class="icon ">
                                <i class="fa fa-line-chart blue-color"></i>
                            </span>
                                        <span class="task-info">Anthony Jones
<small> Done 60% of his task</small>

                            <div class="progress progress-striped">
                                <div style="width: 66%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="66"
                                     role="progressbar" class="progress-bar progress-bar-info"></div>
                            </div>

                            </span>
                                    </a>
                                    <a href="javascript:;">
                            <span class="icon ">
                                <i class="fa fa-heart purple-color"></i>
                            </span>
                                        <span class="task-info">Tawseef
                            <small> Like your task 10 min ago</small>
                                </span>

                                    </a>
                                    <a href="javascript:;">
                            <span class="icon ">
                                <i class="fa fa-check green-color"></i>
                            </span>
                                        <span class="task-info">Anjelina Gomez
<small>completed his task Yesterday</small>
                                </span>
                                    </a>
                                    <a href="javascript:;">
                            <span class="icon ">
                                <i class="fa fa-comments-o"></i>
                            </span>
                                        <span class="task-info">Franklin Anderson
<small>commented on your task 3 Days ago</small>
                            </span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!--task info end-->

                        <!--notification info start-->
                        <li>
                            <a href="javascript:;" class="btn btn-default dropdown-toggle info-number"
                               data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge bg-warning">4</span>
                            </a>

                            <div class="dropdown-menu dropdown-title ">

                                <div class="title-row">
                                    <h5 class="title yellow">
                                        You have 4 New Notification
                                    </h5>
                                    <a href="javascript:;" class="btn-warning btn-view-all">View all</a>
                                </div>
                                <div class="notification-list-scroll sidebar" tabindex="5000"
                                     style="overflow: hidden; outline: none;">
                                    <div class="notification-list mail-list not-list">
                                        <a href="javascript:;" class="single-mail">
                                <span class="icon bg-primary">
                                    <i class="fa fa-envelope-o"></i>
                                </span>
                                            <strong>New User Registration</strong>

                                            <p>
                                                <small>Just Now</small>
                                            </p>
                                            <span class="un-read tooltips" data-original-title="Mark as Read"
                                                  data-toggle="tooltip" data-placement="left">
                                    <i class="fa fa-circle"></i>
                                </span>
                                        </a>
                                        <a href="javascript:;" class="single-mail">
                                <span class="icon bg-success">
                                    <i class="fa fa-comments-o"></i>
                                </span>
                                            <strong> Private message Send</strong>

                                            <p>
                                                <small>30 Mins Ago</small>
                                            </p>
                                            <span class="un-read tooltips" data-original-title="Mark as Read"
                                                  data-toggle="tooltip" data-placement="left">
                                    <i class="fa fa-circle"></i>
                                </span>
                                        </a>
                                        <a href="javascript:;" class="single-mail">
                                <span class="icon bg-warning">
                                    <i class="fa fa-warning"></i>
                                </span> Application Error
                                            <p>
                                                <small> 2 Days Ago</small>
                                            </p>
                                            <span class="read tooltips" data-original-title="Mark as Unread"
                                                  data-toggle="tooltip" data-placement="left">
                                    <i class="fa fa-circle-o"></i>
                                </span>
                                        </a>
                                        <a href="javascript:;" class="single-mail">
                                <span class="icon bg-dark">
                                   <i class="fa fa-database"></i>
                                </span> Database Overloaded 24%
                                            <p>
                                                <small>1 Week Ago</small>
                                            </p>
                                            <span class="read tooltips" data-original-title="Mark as Unread"
                                                  data-toggle="tooltip" data-placement="left">
                                    <i class="fa fa-circle-o"></i>
                                </span>
                                        </a>
                                        <a href="javascript:;" class="single-mail">
                                <span class="icon bg-danger">
                                    <i class="fa fa-warning"></i>
                                </span>
                                            <strong>Server Failed Notification</strong>

                                            <p>
                                                <small>10 Days Ago</small>
                                            </p>
                                            <span class="un-read tooltips" data-original-title="Mark as Read"
                                                  data-toggle="tooltip" data-placement="left">
                                    <i class="fa fa-circle"></i>
                                </span>
                                        </a>

                                    </div>
                                </div>
                                <div id="ascrail2001" class="nicescroll-rails"
                                     style="width: 3px; z-index: 12000; cursor: default; position: absolute; top: 0px; left: -3px; height: 240px; display: none;">
                                    <div style="position: relative; top: 0px; float: right; width: 3px; height: 0px; background-color: rgb(223, 223, 226); background-clip: padding-box; border-radius: 15px;"></div>
                                </div>
                                <div id="ascrail2001-hr" class="nicescroll-rails"
                                     style="height: 3px; z-index: 12000; top: 237px; left: 0px; position: absolute; cursor: default; display: none;">
                                    <div style="position: relative; top: 0px; height: 3px; width: 0px; background-color: rgb(223, 223, 226); background-clip: padding-box; border-radius: 15px;"></div>
                                </div>
                            </div>
                        </li>
                        <!--notification info end-->
                    </ul>
                </div>--}}
                <!--left notification end-->


                    <!--right notification start-->
                    <div class="right-notification">
                        <ul class="notification-menu">
                            <li>

                            </li>

                            <li>
                                <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <img src="/slicklab/img/avatar-mini.jpg"
                                         alt="">{{ auth('admin')->user()->username }}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                                    @if(! auth('admin')->user()->denies('RootChangePassword'))
                                        <li><a href="{{ route('RootChangePassword') }}">{{__('Change Password')}}</a>
                                        </li>
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
                            <li>
                                <div class="sb-toggle-right hidden-xs hidden-sm">
                                    <i class="fa fa-cube"></i>
                                </div>
                            </li>

                        </ul>
                    </div>
                {{--<form class="search-content" action="index.html" method="post">
                    <input type="text" class="form-control" name="keyword" placeholder="Search...">
                </form>--}}
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


            <!-- Right Slidebar start -->
            {{--@include('backend.layouts.sidebar-right')--}}
            <!-- Right Slidebar end -->

        </div>
        <!-- body content end-->
    </div>

</section>

<!-- alert model start-->
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
<!-- alert model end-->

<!-- confirm model start-->
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
<!-- confirm model end-->

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
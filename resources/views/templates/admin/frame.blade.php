<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('img/ic/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('img/ic/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('img/ic/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('img/ic/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('img/ic/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('img/ic/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('img/ic/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('img/ic/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('img/ic/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ url('img/ic/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('img/ic/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('img/ic/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('img/ic/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('img/ic/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ url('img/ic/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="default" name="apple-mobile-web-app-status-bar-style">
    <meta content="" name="description"/>
    <meta content="" name="author"/>


    <title>@yield('title', "Welcome to Kolekta!")</title>

    @section('header')
        @include('templates.admin.components.header')
    @show

</head>
<body class="fixed-header horizontal-menu horizontal-app-menu dashboard">
    <div class="header p-r-0 bg-primary">
        <div class="header-inner header-md-height">
            <a class="btn-link toggle-sidebar hidden-lg-up pg pg-menu text-white" data-toggle="horizontal-menu" href="#"></a>
            <div>
                <div class="brand inline no-border hidden-xs-down text-white bold">KOLEKTA</div>
                <ul class="hidden-md-down notification-list no-margin hidden-sm-down b-grey b-l b-r no-style p-l-30 p-r-20">
                    <li class="p-r-10 inline">
                        <div class="dropdown">
                            <a class="header-icon pg pg-world" data-toggle="dropdown" href="javascript:;" id="notification-center"><span class="bubble"></span></a>
                            <div aria-labelledby="notification-center" class="dropdown-menu notification-toggle" role="menu">
                                <div class="notification-panel">
                                    <div class="notification-body scrollable">
                                        <div class="notification-item clearfix">
                                            <div class="heading">
                                                <a class="text-danger pull-left" href="#"><i class="fa fa-exclamation-triangle m-r-10"></i> <span class="bold">98% Server Load</span> <span class="fs-12 m-l-10">Take Action</span></a> <span class="pull-right time">2 mins ago</span>
                                            </div>
                                            <div class="option">
                                                <a class="mark" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="notification-footer text-center">
                                        <a class="" href="#">Read all notifications</a> <a class="portlet-refresh text-black pull-right" data-toggle="refresh" href="#"><i class="pg-refresh_new"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="p-r-10 inline">
                        <a class="header-icon pg pg-link" href="#"></a>
                    </li>
                    <li class="p-r-10 inline">
                        <a class="header-icon pg pg-thumbs" href="#"></a>
                    </li>
                </ul>
                <a class="search-link hidden-md-down" data-toggle="search" href="#">
                    <div class="input-group transparent search-nav no-border">
                        <span class="input-group-addon no-border">
                            <i class="pg-search fs-14 text-white"></i>
                        </span>
                        <input type="search" placeholder="Type here to Search" class="form-control input-search">
                    </div>
                </a>
            </div>
            <div class="d-flex align-items-center">
                <div class="pull-left font-heading hidden-md-down text-white m-r-10">
                    <span class="font-weight-normal">{{ Auth::User()->name }}</span>
                </div>
                <div class="dropdown pull-right">
                    <button aria-expanded="false" aria-haspopup="true" class="profile-dropdown-toggle" data-toggle="dropdown" type="button">
                        <span class="thumbnail-wrapper d32 circular inline m-r-0">
                            <a class="header-icon pg pg-settings btn-link sm-no-margin d-inline-block text-white"></a>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                        <a class="dropdown-item" href="{{ route('user.account') }}"><i class="pg-settings_small"></i> Settings</a>
                        <a class="dropdown-item" href="#"><i class="pg-outdent"></i> Feedback</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-question-circle"></i> Help</a>
                        <a class="clearfix bg-master-lighter dropdown-item" href="{{ route('logout') }}"><span class="pull-left">Logout</span> <span class="pull-right"><i class="pg-power"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white">
            <div class="container">
                <div class="menu-bar header-sm-height" data-hide-extra-li="4" data-pages-init='horizontal-menu'>
                    <a class="btn-link toggle-sidebar hidden-lg-up pg pg-close" data-toggle="horizontal-menu" href="#"></a>
                    @include('templates.admin.components.menus')
                    <a class="search-link d-flex justify-content-between align-items-center hidden-lg-up" data-toggle="search" href="#">
                        <div class="input-group transparent search-nav no-border">
                        <span class="input-group-addon no-border">
                            <i class="pg-search fs-14 text-white"></i>
                        </span>
                            <input type="search" placeholder="Type here to Search" class="p-l-25 form-control input-search">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if(!Request::is('survey/create*'))
        <div class="page-container">
            @yield('content')
            @include('templates.admin.components.footer')
        </div>
    @else
        @yield('content')
    @endif
    @section('scripts')
    @include('templates.admin.components.script')
    <script>
        $(document).ajaxStart(function() { Pace.restart(); });
    </script>
    @stack('script')
</body>
</html>

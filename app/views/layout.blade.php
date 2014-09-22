<!DOCTYPE html>
<html lang=en>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset=utf-8>
    <title>Dashboard</title>
    <!-- Mobile specific metas -->
    <meta name=viewport content="width=device-width,initial-scale=1,maximum-scale=1">
    <!-- Force IE9 to render in normal mode -->
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name=author content=Danula>
    <meta name=description content="blah">
    <meta name=keywords content="">
    <meta name=application-name content="Locals Advise">
    <!-- Import google fonts - Heading first/ text second -->
    <link rel=stylesheet type=text/css href="http://fonts.googleapis.com/css?family=Open+Sans:400,700|Droid+Sans:400,700">
    <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->
    <!-- Css files -->
    {{HTML::style('assets/css/main.min.css')}}
    <!-- Fav and touch icons -->
    <link rel=apple-touch-icon-precomposed sizes=144x144 href=assets/img/ico/apple-touch-icon-144-precomposed.png>
    <link rel=apple-touch-icon-precomposed sizes=114x114 href=assets/img/ico/apple-touch-icon-114-precomposed.png>
    <link rel=apple-touch-icon-precomposed sizes=72x72 href=assets/img/ico/apple-touch-icon-72-precomposed.png>
    <link rel=apple-touch-icon-precomposed href=assets/img/ico/apple-touch-icon-57-precomposed.png>
    <link rel=icon href=assets/img/ico/favicon.ico type=image/png>
    <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
    <meta name=msapplication-TileColor content=#3399cc>
    @yield('head')
<body>
<!-- Start #header -->
<div id='header'>
    <div class='container-fluid'>
        <div class='navbar'>
            <div class='navbar-header animated bounceIn'>{{HTML::image('assets/img/logo.png')}}</div>
            <nav class=top-nav role=navigation>
                <ul class="nav navbar-nav pull-left">
                    <li id='toggle-sidebar-li'><a href=# id='toggle-sidebar'><i class=en-arrow-left2></i></a></li>
                    <li><a href=# class=full-screen><i class=fa-fullscreen></i></a></li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    
                    <li class=dropdown><a href=# data-toggle=dropdown>
                            @if(Auth::user()->photo)
                            {{ HTML::image('assets/img/avatars/'.Auth::user()->id.'.jpg', Auth::user()->name,array('class' => 'user-avatar'));}}
                            @else
                            {{ HTML::image('assets/img/avatars/default.jpg', Auth::user()->name,array('class' => 'user-avatar'));}}
                            @endif
                            {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu right" role=menu>
                            <li>{{HTML::decode(HTML::link('/', '<i class="st-user"></i>Profile'))}}</li>
                            <li><a href=#><i class=st-settings></i> Settings</a></li>                           
                            <li>{{HTML::decode(HTML::link('logout', '<i class="im-exit"></i>Logout'))}}</li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- End #header -->
<!-- Start #sidebar -->
<div id='sidebar'>
    <!-- Start .sidebar-inner -->
    <div class=sidebar-inner>
        <!-- Start #sideNav -->
        <ul id='sideNav' class="nav nav-pills nav-stacked">
            <li>{{HTML::decode(HTML::link('/', '<i class="en-house"></i>Home'))}}</li>            
            <li>{{HTML::decode(HTML::link('map/add', '<i class="en-question"></i>Ask Questions'))}}</li>
            <li>{{HTML::decode(HTML::link('map', '<i class="en-comment"></i>Answer Questions'))}}</li>         
        </ul>
        <!-- End #sideNav -->
        <!-- Start .sidebar-panel -->
        <div class=sidebar-panel>
            @yield('sidebar-panel')          
        </div>
        <!-- End .sidebar-panel -->
    </div>
    <!-- End .sidebar-inner -->
</div>
<!-- End #sidebar -->

@yield('content')

<!-- End .outlet -->
</div>
<!-- End .content-wrapper -->
<div class=clearfix></div>
</div>
<!-- End #content -->
<!-- Javascripts -->
@yield('scripts')
<!-- Load pace first -->
{{HTML::script('assets/plugins/core/pace/pace.min.js')}}
<!-- Important javascript libs(put in all pages) -->
<script>window.jQuery || document.write('<script src="assets/js/libs/jquery-2.1.1.min.js">\x3C/script>')</script>
<script src=http://code.jquery.com/ui/1.10.4/jquery-ui.js></script>
<script>window.jQuery || document.write('<script src="assets/js/libs/jquery-ui-1.10.4.min.js">\x3C/script>')</script>
<!--[if lt IE 9]>
<script type="text/javascript" src="assets/js/libs/excanvas.min.js"></script>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script type="text/javascript" src="assets/js/libs/respond.min.js"></script>
<![endif]-->
{{HTML::script('assets/js/pages/dashboard.js')}}
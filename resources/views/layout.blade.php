<!DOCTYPE html>
<!--[if IE 9 ]>
<html class="ie9"><![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KCC Admin</title>

    <!-- Vendor CSS -->
    <link href="/css/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="/css/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
    <link href="/css/vendors/bower_components/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="/css/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css"
          rel="stylesheet">
    <link href="/css/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css"
          rel="stylesheet">
    <link href="/css/vendors/bower_components/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/css/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="/css/vendors/bower_components/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <!-- CSS -->
    <link href="/css/app_1.min.css" rel="stylesheet">
    <link href="/css/app_2.min.css" rel="stylesheet">

    <script src="/css/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/css/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>--}}
</head>

<body>
<header id="header" class="clearfix" data-ma-theme="blue">
    <ul class="h-inner">
        <li class="hi-trigger ma-trigger" data-ma-action="sidebar-open" data-ma-target="#sidebar">
            <div class="line-wrap">
                <div class="line top"></div>
                <div class="line center"></div>
                <div class="line bottom"></div>
            </div>
        </li>

        <li class="hi-logo hidden-xs">
            <a href="/admin">KCC Admin</a>
        </li>

    </ul>
</header>

<section id="main">
    <aside id="sidebar" class="sidebar c-overflow">
        <?php $url=\Request::getRequestUri();$segment=Request::segment(2);?>
        <ul class="main-menu">
            <li class="sub-menu {{strpos($url,'home')?'active':''}}">
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-home"></i>首頁</a>
                <ul>
                    <li {{($segment=='home_banner')?'class=active':''}}><a href="/home/home_banner">Banner管理</a></li>
                    {{--<li {{($segment=='home_seo')?'class=active':''}}><a href="/home/home_seo">首頁SEO</a></li>--}}
                </ul>
            </li>
            <li class="sub-menu {{strpos($url,'about')?'active':''}}">
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-label"></i>關於</a>
                <ul>
                    <li {{($segment=='about_research_category')?'class=active':''}}><a href="/about/about_research_category">研發創新</a></li>
                    {{--<li {{($segment=='about_research_seo')?'class=active':''}}><a href="/about/about_research_seo">研發創新SEO</a></li>--}}
                </ul>
            </li>
            <li class="sub-menu {{strpos($url,'product')?'active':''}}">
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-comfy"></i>產品</a>
                <ul>
                    <li {{($url=='/product')?'class=active':''}}><a href="/product">產品管理</a></li>
                    {{--<li {{($segment=='product_seo')?'class=active':''}}><a href="/product/product_seo">產品SEO</a></li>--}}
                    <li {{($segment=='product_application')?'class=active':''}}><a href="/product/product_application">Application</a></li>
                    {{--<li {{($segment=='product_application_seo')?'class=active':''}}><a href="/product/product_application_seo">Application SEO</a></li>--}}
                    <li {{($segment=='product_star')?'class=active':''}}><a href="/product/product_star">明星商品</a></li>
                    {{--<li {{($segment=='product_star_seo')?'class=active':''}}><a href="/product/product_star_seo">明星商品SEO</a></li>--}}
                </ul>
            </li>
            <li class="sub-menu {{strpos($url,'news')?'active':''}}">
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-comment-alt-text"></i>最新消息</a>
                <ul>
                    <li {{($url=='/news')?'class=active':''}}><a href="/news">消息管理</a></li>
                    {{--<li {{($segment=='news_seo')?'class=active':''}}><a href="/news/news_seo">消息SEO</a></li>--}}
                </ul>
            </li>
            <li>
                <a href="/login/logout"><i class="zmdi zmdi-rotate-left"></i> 登出</a>
            </li>
        </ul>
    </aside>

    <section id="content">
        <div class="container">
            <div class="block-header">
                @include($main)
            </div>
        </div>
    </section>
</section>

<footer id="footer">
    Copyright &copy; 2017 KCC Admin
</footer>

<!-- Page Loader -->
<div class="page-loader">
    <div class="preloader pls-blue">
        <svg class="pl-circular" viewBox="25 25 50 50">
            <circle class="plc-path" cx="50" cy="50" r="20"/>
        </svg>

        <p>Please wait...</p>
    </div>
</div>

<!-- Older IE warning message -->
<!--[if lt IE 9]>
<div class="ie-warning">
    <h1 class="c-white">Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="img/browsers/chrome.png" alt="">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="img/browsers/firefox.png" alt="">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="img/browsers/opera.png" alt="">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="img/browsers/safari.png" alt="">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="img/browsers/ie.png" alt="">
                    <div>IE (New)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->

<!-- Javascript Libraries -->


<script src="/css/vendors/bower_components/flot/jquery.flot.js"></script>
<script src="/css/vendors/bower_components/flot/jquery.flot.resize.js"></script>
<script src="/css/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
<script src="/css/vendors/sparklines/jquery.sparkline.min.js"></script>
<script src="/css/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="/css/vendors/bower_components/moment/min/moment.min.js"></script>
<script src="/css/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js "></script>
<script src="/css/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
<script src="/css/vendors/bower_components/Waves/dist/waves.min.js"></script>
<script src="/css/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
<script src="/css/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/css/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/css/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- Placeholder for IE9 -->
<!--[if IE 9 ]>
<script src="/css/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
<![endif]-->

<script src="/js/js_template/app.min.js"></script>
</body>
</html>
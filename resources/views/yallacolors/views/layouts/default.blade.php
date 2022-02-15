<!DOCTYPE html>
<!-- بسم الله الرحمن الرحيم -->
<!--[if IE 8]> <html lang="{{ LaravelLocalization::getCurrentLocale() }}" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
<!--<![endif]-->
<head>
    @include('partials.head')
</head>
<body dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" class="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

        @include('partials.header')
        @include('core::admin.partials.sideBar')

        @include('core::admin.partials.alerts.topGlobalAlerts')

        @yield('content')

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    @include('partials.footer')
    @include('partials.footerScripts')
</body>
</html>
<meta charset="utf-8"/>
<title>@yield('PageTitle', trans('core::adminMain.control') . ' - ' . website()->title)</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>{!! Theme::style('assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') !!}{!! Theme::style('assets/plugins/bootstrap/css/bootstrap.min.css') !!}

@if( LaravelLocalization::getCurrentLocaleDirection() == 'rtl' )
	{!! Theme::style('assets/css/bootstrap-rtl.min.css') !!}
@endif

{!! Theme::style('assets/css/all.min.css') !!}
{!! Theme::style('assets/css/animate.min.css') !!}
{!! Theme::style('assets/css/style.min.css') !!}
{!! Theme::style('assets/css/style-responsive.min.css') !!}
{!! Theme::style('assets/css/theme/blue.css') !!}
{!! Theme::style('assets/plugins/flag-icon/css/flag-icon.css') !!}
{!! Theme::style('assets/css/rtl_9_9_2021.css') !!}
<!-- ================== END BASE CSS STYLE ================== -->
<!--[select2 plugin]-->
{!! Theme::style('assets/plugins/select2/4.0.3/dist/css/select2.min.css') !!}
<!-- use to make side alert -->
{!! Theme::style('assets/css/jquery.jgrowl.min.css') !!}
{!! Theme::style('assets/plugins/switchery/switchery.min.css') !!}

@yield('customCss')

{!! Theme::style('assets/css/custom_12_1_2021.css') !!}

<!-- ================== BEGIN BASE JS ================== -->
{!! Theme::script('assets/plugins/pace/pace.min.js') !!}
<!-- ================== END BASE JS ================== -->

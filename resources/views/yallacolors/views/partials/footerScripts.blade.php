<!-- ================== BEGIN BASE JS ================== -->
{!! Theme::script('assets/plugins/jquery/jquery-1.9.1.min.js') !!}
{!! Theme::script('assets/plugins/jquery/jquery-migrate-1.1.0.min.js') !!}
{!! Theme::script('assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') !!}
{!! Theme::script('assets/plugins/bootstrap/js/bootstrap.min.js') !!}
<!--[if lt IE 9]>
{!! Theme::script('assets/crossbrowserjs/html5shiv.js') !!}
{!! Theme::script('assets/crossbrowserjs/respond.min.js') !!}
{!! Theme::script('assets/crossbrowserjs/excanvas.min.js') !!}
{!! Theme::script('assets/js/clipboard.min.js') !!}
<![endif]-->

{!! Theme::script('assets/plugins/slimscroll/jquery.slimscroll.min.js') !!}
{!! Theme::script('assets/plugins/jquery-cookie/jquery.cookie.js') !!}
<!--[select2 plugin]-->
{!! Theme::script('assets/plugins/select2/4.0.3/dist/js/select2.min.js') !!}
<!-- use to make side alert -->
{!! Theme::script('assets/js/jquery.jgrowl.min.js') !!}
{!! Theme::script('assets/js/apps.min.js') !!}
{!! Theme::script('assets/js/all.min.js') !!}

{!! Theme::script('assets/plugins/switchery/switchery.min.js') !!}
{!! Theme::script('assets/js/form-slider-switcher.demo.js') !!}
<!-- ================== END BASE JS ================== -->

<script>
    $(document).ready(function () {
        FormSliderSwitcher.init();
        App.init();
    });

    $('.select2').select2({
		@if(currentLocale() == 'ar')
        dir: "rtl",
		@endif
    });

    function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var text = (evt.which) ? evt.which : evt.keyCode;

        if (text > 31 && (text < 48 || text > 57))
            return false;
        return true;
    }
</script>

@yield('footerScripts')

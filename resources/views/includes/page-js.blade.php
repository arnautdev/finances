<script type="text/javascript">
    var $appLocale = '{{ app()->getLocale() }}';
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/js/theme/default.js') }}"></script>
<script src="{{ asset('assets/js/apps.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/dashboard.js') }}"></script>
<script defer>
    $(document).ready(function () {
        try {
            App.init();
            Dashboard.init();
        } catch (e) {
            console.error(e);
        }
    });
</script>

@stack('scripts')

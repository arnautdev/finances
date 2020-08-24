<script type="text/javascript">
    var $appLocale = '{!! app()->getLocale() !!}';
</script>
<script src="{{ asset('app/js/app.js') }}" type="text/javascript"></script>


@stack('scripts')
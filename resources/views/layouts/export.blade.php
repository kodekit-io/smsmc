@include('includes.header')
@include('includes.nav')
@yield('content')

        <footer class="sm-footer">
            Copyright &copy; <?php echo date('Y'); ?> <a class="grey-text text-darken-1" href="http://www.sinarmas.com" target="_blank" title="Sinar Mas">Sinar Mas</a> | Powered by <a class="grey-text text-darken-1" href="http://www.mediawave.biz" target="_blank" title="MediaWave">MediaWave</a>
            <a class="uk-icon-button uk-float-right sm-totop" title="back to top" uk-totop uk-scroll uk-tooltip="pos: top-right"></a>
        </footer>

    @section('page-level-js-variables')
        <script type="text/javascript">
            var baseUrl = '{!! url('/') !!}';
            var token = '{!! csrf_token() !!}';
        </script>
    @show

    <script src="{!! asset('assets/js/lib/numeral.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.datetimepicker.js') !!}"></script>
    <script src="{!! asset('assets/js/main.js') !!}"></script>
    @section('page-level-scripts')
    @show

    </body>
</html>

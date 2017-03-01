
        <footer class="sm-footer">
            Copyright &copy; <?php echo date('Y'); ?> <a class="grey-text text-darken-1" href="http://www.sinarmas.com" target="_blank" title="Sinarmas">Sinarmas</a> | Powered by <a class="grey-text text-darken-1" href="http://www.mediawave.biz" target="_blank" title="MediaWave">MediaWave</a>
            <a class="uk-icon-button uk-float-right sm-totop" title="back to top" uk-totop uk-scroll uk-tooltip="pos: top-right"></a>
            <a class="btn-unhide uk-icon-button teal white-text uk-hidden" onclick="unhideAll(this)" title="Unhide All" uk-tooltip><i class="fa fa-eye"></i></a>
            <a class="btn-screenshot uk-icon-button cyan white-text" title="Save Page" uk-tooltip onclick="savePage()"><i class="fa fa-camera"></i></a>
        </footer>
        
    @section('page-level-js-variables')
        <script type="text/javascript">
            var baseUrl = '{!! url('/') !!}';
        </script>
    @show

    <script src="{!! asset('assets/js/lib/html2canvas.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.plugin.html2canvas.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/numeral.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.datetimepicker.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.checkall.js') !!}"></script>

    @section('page-level-scripts')
    @show
    <script src="{!! asset('assets/js/main.js') !!}"></script>
    </body>
</html>

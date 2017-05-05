
        <footer class="sm-footer">
            Copyright &copy; <?php echo date('Y'); ?> <a class="grey-text text-darken-1" href="http://www.sinarmas.com" target="_blank" title="Sinar Mas">Sinar Mas</a> | Powered by <a class="grey-text text-darken-1" href="http://www.mediawave.biz" target="_blank" title="MediaWave">MediaWave</a>
            <a class="uk-icon-button uk-float-right sm-totop" title="back to top" uk-totop uk-scroll uk-tooltip="pos: top-right"></a>
            <a class="btn-unhide uk-icon-button teal white-text uk-hidden" onclick="unhideAll(this)" title="Unhide All" uk-tooltip><i class="fa fa-eye"></i></a>
            <a class="btn-screenshot uk-icon-button cyan white-text" title="Save Page" uk-tooltip onclick="savePage()"><i class="fa fa-camera"></i></a>
        </footer>

    @section('page-level-js-variables')
        <script type="text/javascript">
            var baseUrl = '{!! url('/') !!}';
            var token = '{!! csrf_token() !!}';

            // load notif for the 1st time
            alertFunc();

            myVar = setInterval(alertFunc, 10000);
            function alertFunc() {
                $.ajax({
                    url: baseUrl + '/get-notification'
                }).done(function($res) {
                    var $result = $.parseJSON($res);
                    $('.notification-badge').append('<span class="uk-badge uk-badge-notification">'+$result.ticketNotification+'</span>');
                    $('.notification-number').html($result.ticketNotification + ' New');
                    $notifications = $result.detail;
                    $('.notification-list').empty();
                    for(i=0;i<$notifications.length;i++) {
                        $('.notification-list').append('<li class="uk-grid-small" uk-grid> \
                            <div class="uk-width-auto@s"> \
                            <span class="fa fa-lg fa-exclamation-circle red-text"></span> \
                            </div> \
                            <div class="uk-width-expand@s"> \
                            <span class="uk-article-meta"> \
                            ' + $notifications[i].date + ' \
                        </span><br> \
                        <a href="' + baseUrl + '/ticket/' + $notifications[i].ticketId + '/detail"> \
                            '+$notifications[i].message+' \
                        <span class="fa fa-fw fa-arrow-right" title="See details" uk-tooltip></span> \
                        </a> \
                        </div> \
                        </li>');
                    }
                });
            }
        </script>
    @show

    <script src="{!! asset('assets/js/lib/html2canvas.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.plugin.html2canvas.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/numeral.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.datetimepicker.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.checkall.js') !!}"></script>
    <script src="{!! asset('assets/js/main.js') !!}"></script>
    @section('page-level-scripts')
    @show

    </body>
</html>

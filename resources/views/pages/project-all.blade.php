@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-project')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-grid-medium uk-child-width-1-2@m " uk-grid uk-sortable="handle: .uk-card-header">
            <div id="01"></div>
            <div id="02"></div>
            <div id="03"></div>
            <div id="04"></div>
            <div id="05"></div>
            <div id="06"></div>
            <div id="07"></div>
            <div id="08"></div>
            <div id="09"></div>
            <div id="10"></div>
            <div id="11"></div>
            <div id="12"></div>
            <div id="13"></div>
            <div id="14"></div>
            <div id="15"></div>
            <div id="16"></div>
            {{-- <div id="17" class="uk-width-1-1"></div> --}}
            <div id="17" class="uk-width-1-1">
                <div id="405" class="sm-chart-container uk-animation-fade">
                    <div class="uk-card uk-card-hover uk-card-default uk-card-small">
                        <div class="uk-card-header uk-clearfix">
                            <h5 class="uk-card-title uk-float-left convo-title">Conversation</h5>
                            <ul class="uk-float-right uk-subnav uk-margin-remove">
                                <li><a class="grey-text fa fa-info-circle convo-info" title="All Media Conversation" uk-tooltip></a></li>
                                <li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>
                                <li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>
                            </ul>
                        </div>
                        <div class="uk-card-body">
                            <div class="uk-overflow-auto">
                                <ul class="uk-child-width-expand" uk-tab>
                                    <li class="uk-active"><a><i class="fa fa-facebook"></i><span class="uk-visible@m">Facebook</span></a></li>
                                    <li><a><i class="fa fa-twitter"></i><span class="uk-visible@m"> Twitter</span></a></li>
                                    <li><a><i class="fa fa-globe"></i><span class="uk-visible@m"> News</span></a></li>
                                    <li><a><i class="fa fa-globe"></i><span class="uk-visible@m"> Int. News</span></a></li>
                                    <li><a><i class="fa fa-rss"></i><span class="uk-visible@m"> Blog</span></a></li>
                                    <li><a><i class="fa fa-comments"></i><span class="uk-visible@m"> Forum</span></a></li>
                                    <li><a><i class="fa fa-youtube-play"></i><span class="uk-visible@m"> Video</span></a></li>
                                    <li><a><i class="fa fa-instagram"></i><span class="uk-visible@m"> Instagram</span></a></li>
                                </ul>
                                <ul class="uk-switcher uk-margin">
                                    <li>
                                        <div class="uk-overflow-auto">
                                            <table id="convoFacebook" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="uk-overflow-auto">
                                            <table id="convoTwitter" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="uk-overflow-auto">
                                            <table id="convoNews" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="uk-overflow-auto">
                                            <table id="convoNewsInt" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="uk-overflow-auto">
                                            <table id="convoBlog" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="uk-overflow-auto">
                                            <table id="convoForum" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="uk-overflow-auto">
                                            <table id="convoVideo" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="uk-overflow-auto">
                                            <table id="convoInstagram" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/extension/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jqcloud.js') !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="{!! asset('assets/js/charts/getTotalMedia.js') !!}"></script>

    <script src="{!! asset('assets/js/charts/chartBubble.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartBar.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartTrend.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartPie.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartOntology.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/tableInfluencers.js') !!}"></script>

    <script src="{!! asset('assets/js/charts/tableConvo.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoFacebook.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoTwitter.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoNews.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoBlog.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoForum.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoVideo.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoInstagram.js') !!}"></script>

    <script>
        $(document).ready(function() {
            var $projectId = '{!! $projectId !!}';
            var $startDate = '{!! $startDate !!}';
            var $endDate = '{!! $endDate !!}';
            var $keywords = '{!! $submittedKeywords !!}';
            var $topics = '{!! $submittedTopics !!}';
            var $sentiments = '{!! $submittedSentiments !!}';
            var $text = '{!! $searchText !!}';
            var $shownStartDate = '{!! $shownStartDate !!}';
            var $shownEndDate = '{!! $shownEndDate !!}';
            // var sdateval = moment.parseZone($startDate).local().format('DD/MM/YY HH:mm');
            // var edateval = moment.parseZone($endDate).local().format('DD/MM/YY HH:mm');
            // $('input[name="startDate"]').val(sdateval);
            // $('input[name="endDate"]').val(edateval);
            console.log('startDate requested: '+$shownStartDate);
            console.log('startDate sent to api: '+$startDate);
            console.log('endDate requested: '+$shownEndDate);
            console.log('endDate sent to api: '+$endDate);

            var $chartData = {
                "_token": token,
                "projectId": $projectId,
                "startDate": $startDate,
                "endDate": $endDate,
                "keywords": $keywords,
                "topics": $topics,
                "sentiments": $sentiments,
                "text": $text,
                "idMedia": 8,
                "reportType": 1,
                "createTicketUrl": '{!! url('convo/create-ticket') !!}',
                "changeSentimentUrl": '{!! url('change-sentiment') !!}',
                "ticketTypes": '{!! $ticketTypes !!}',
                'users': '{!! $users !!}',
                'groups': '{!! $groups !!}'
            };

            getTotalMedia(baseUrl + '/charts/bar-media-share', $chartData);

            chartBubble('01', baseUrl + '/charts/brand-equity/1', $chartData);
            chartBarStack('02', baseUrl + '/charts/bar-sentiment/1', $chartData);
            chartTrendCombo('03', baseUrl + '/charts/trend-sentiment/1', $chartData);
            chartTrend('04', baseUrl + '/charts/trend-post/1', $chartData);
            chartTrend('05', baseUrl + '/charts/trend-buzz/1', $chartData);
            chartTrend('06', baseUrl + '/charts/trend-reach/1', $chartData);
            chartTrend('07', baseUrl + '/charts/trend-interaction/1', $chartData);
            chartPie('08', baseUrl + '/charts/pie-post/1', $chartData);
            chartPie('09', baseUrl + '/charts/pie-buzz/1', $chartData);
            chartPie('10', baseUrl + '/charts/pie-interaction/1', $chartData);
            chartPie('11', baseUrl + '/charts/pie-unique-user/1', $chartData);
            chartBar('12', baseUrl + '/charts/bar-interaction-rate/1', $chartData);
            chartBarStack('13', baseUrl + '/charts/bar-media-share/1', $chartData);
            chartBarStack('14', baseUrl + '/charts/bar-topic-distribution/1', $chartData);
            chartOntology('15', baseUrl + '/charts/ontologi/1', $chartData);
            wordcloud('16', baseUrl + '/charts/wordcloud/1', $chartData);

        	tableConvo('convoFacebook', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 1);
            tableConvo('convoTwitter', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 2);
            tableConvo('convoNews', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 4);
            tableConvo('convoNewsInt', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 9);
            tableConvo('convoBlog', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 3);
            tableConvo('convoForum', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 6);
            tableConvo('convoVideo', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 5);
            tableConvo('convoInstagram', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 7);

            // $.ajax({
            //     url: baseUrl + "/charts/download-convo-all",
            //     method: "POST",
            //     data: $chartData
            // }).done(function (downloadLink) {
            //     var btnExcel = '<li><a class="uk-button uk-button-small green darken-2 white-text" href="'+downloadLink+'" id="download_excel" target="_blank" title="Export All Media Conversations to Excel" uk-tooltip>EXPORT ALL CONVERSATIONS</a></li>';
            //     $('div#405').find('.uk-card-body').append(btnExcel);
            // });
            var btnExcel = '<a class="uk-button uk-button-small uk-margin-top green darken-2 white-text" id="download_excel" target="_blank" title="Export All Media Conversations to Excel" uk-tooltip>EXPORT ALL CONVERSATIONS</a>';
            $('div#405').find('.uk-card-body').append(btnExcel);
            $('#download_excel').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: baseUrl + "/charts/download-convo-all",
                    method: "POST",
                    data: $chartData,
                    beforeSend: function (xhr) {
                        $('#download_excel').text('PLEASE WAIT...');
                    }
                }).done(function (downloadLink) {
                    $('#download_excel').text('DOWNLOADED!');
                    setTimeout(function() {
                        $('#download_excel').text('EXPORT ALL CONVERSATIONS');
                    }, 3000);
                    window.location = downloadLink;
                });
            });
        });
    </script>
@endsection

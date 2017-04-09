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
        <div class="uk-grid-medium uk-child-width-1-2@m uk-child-width-1-4@xl" uk-grid uk-sortable="handle: .uk-card-header">
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
            <div id="17" class="uk-width-1-1"></div>
            <div id="18" class="uk-width-1-1">
                <div id="405" class="sm-chart-container uk-animation-fade">
                    <div class="uk-card uk-card-hover uk-card-default uk-card-small">
                        <div class="uk-card-header uk-clearfix">
                            <h5 class="uk-card-title uk-float-left convo-title"></h5>
                            <ul class="uk-float-right uk-subnav uk-margin-remove">
                                <li><a class="grey-text fa fa-info-circle convo-info" title="" uk-tooltip></a></li>
                                <li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>
                                <li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>
                            </ul>
                        </div>
                        <div class="uk-card-body">
                            <ul class="uk-child-width-expand" uk-tab>
                                <li class="uk-active"><a href="#">Facebook</a></li>
                                <li><a href="#">Twitter</a></li>
                                <li><a href="#">News</a></li>
                                <li><a href="#">Int. News</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Forum</a></li>
                                <li><a href="#">Video</a></li>
                                <li><a href="#">Instagram</a></li>
                            </ul>
                            <ul class="uk-switcher uk-margin">
                                <li>
                                    <table id="convoFacebook" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                </li>
                                <li>
                                    <table id="convoTwitter" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                </li>
                                <li>
                                    <table id="convoNews" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                </li>
                                <li>
                                    <table id="convoNewsInt" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                </li>
                                <li>
                                    <table id="convoBlog" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                </li>
                                <li>
                                    <table id="convoForum" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                </li>
                                <li>
                                    <table id="convoVideo" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                </li>
                                <li>
                                    <table id="convoInstagram" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
                                </li>
                            </ul>

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
    <script src="{!! asset('assets/js/datatables/extensions/dataTables.buttons.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/extensions/jszip.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/extensions/buttons.html5.min.js') !!}"></script>
    {{-- <script src="{!! asset('assets/js/datatables/extensions/pdfmake.min.js') !!}"></script> --}}
    <script src="{!! asset('assets/js/datatables/extensions/vfs_fonts.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jqcloud.js') !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="{!! asset('assets/js/charts/chartBubble.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartBar.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartTrend.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartPie.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartOntology.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/tableInfluencers.js') !!}"></script>

    <script src="{!! asset('assets/js/charts/convoAllmedia.js') !!}"></script>

    <script>
        $(document).ready(function() {
            var $projectId = '{!! $projectId !!}';
            var $startDate = '{!! $startDate !!}';
            var $endDate = '{!! $endDate !!}';
            var $keywords = '{!! $submittedKeywords !!}';
            var $topics = '{!! $submittedTopics !!}';
            var $sentiments = '{!! $submittedSentiments !!}';
            var $text = '{!! $searchText !!}';

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
                'users': '{!! $users !!}'
            };

            chartBubble('01', baseUrl + '/charts/brand-equity', $chartData);
            chartBarStack('02', baseUrl + '/charts/bar-sentiment', $chartData);
            chartTrendCombo('03', baseUrl + '/charts/trend-sentiment', $chartData);
            chartTrend('04', baseUrl + '/charts/trend-post', $chartData);
            chartTrend('05', baseUrl + '/charts/trend-buzz', $chartData);
            chartTrend('06', baseUrl + '/charts/trend-reach', $chartData);
            chartTrend('07', baseUrl + '/charts/trend-interaction', $chartData);
            chartPie('08', baseUrl + '/charts/pie-post', $chartData);
            chartPie('09', baseUrl + '/charts/pie-buzz', $chartData);
            chartPie('10', baseUrl + '/charts/pie-interaction', $chartData);
            chartPie('11', baseUrl + '/charts/pie-unique-user', $chartData);
            chartBar('12', baseUrl + '/charts/bar-interaction-rate', $chartData);
            chartBarStack('13', baseUrl + '/charts/bar-media-share', $chartData);
            chartBarStack('14', baseUrl + '/charts/bar-topic-distribution', $chartData);
            chartOntology('15', baseUrl + '/charts/ontologi', $chartData);
            wordcloud('16', baseUrl + '/charts/wordcloud', $chartData);
        });
    </script>
@endsection

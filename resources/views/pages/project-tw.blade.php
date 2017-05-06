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
            <div id="13" class="uk-width-1-1"></div>
            <div id="14" class="uk-width-1-1"></div>
            <div id="15" class="uk-width-1-1">
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
                            {{-- <a class="uk-button uk-button-small green darken-2 white-text" href="#" id="download_excel">Download EXCEL</a> --}}
                            <table id="convoTable" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>
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
    {{-- <script src="{!! asset('assets/js/datatables/extensions/dataTables.buttons.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('assets/js/datatables/extensions/jszip.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('assets/js/datatables/extensions/buttons.html5.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('assets/js/datatables/extensions/pdfmake.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('assets/js/datatables/extensions/vfs_fonts.js') !!}"></script> --}}
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
    <script src="{!! asset('assets/js/charts/tableConvo.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoTwitter.js') !!}"></script>

    <script>
        $(document).ready(function() {
            var influencers = ["top10ByReachTW", "top10ByNumberTW", "top10ByImpactTW"];
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
                "idMedia": 2,
                "reportType": 1,
                "createTicketUrl": '{!! url('convo/create-ticket') !!}',
                "changeSentimentUrl": '{!! url('change-sentiment') !!}',
                "ticketTypes": '{!! $ticketTypes !!}',
                'users': '{!! $users !!}'
            };

            // chartTrendCombo('01', baseUrl + '/charts/trend-sentiment', $chartData);
            // chartTrend('02', baseUrl + '/charts/trend-buzz', $chartData);
            // chartTrend('03', baseUrl + '/charts/trend-user', $chartData);
            // chartTrend('04', baseUrl + '/charts/trend-reach', $chartData);
            // chartPie('05', baseUrl + '/charts/pie-buzz', $chartData);
            // chartPie('06', baseUrl + '/charts/pie-interaction', $chartData);
            // chartPie('07', baseUrl + '/charts/pie-viral-reach', $chartData);
            // chartPie('08', baseUrl + '/charts/pie-potential-reach', $chartData);
            // chartBarStack('09', baseUrl + '/charts/bar-sentiment', $chartData);
            // chartBar('10', baseUrl + '/charts/bar-interaction-rate', $chartData);
            // chartBarStack('11', baseUrl + '/charts/bar-topic-distribution', $chartData);
            // wordcloud('12', baseUrl + '/charts/wordcloud', $chartData);
            // chartOntology('13', baseUrl + '/charts/ontologi', $chartData);
            // tableInfluencers('14', baseUrl + '/charts/influencer', $chartData, influencers);
            tableConvo('convoTable', baseUrl + '/charts/paging-convo', $chartData);
        });
    </script>
@endsection

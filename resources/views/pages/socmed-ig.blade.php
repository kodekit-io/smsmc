@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-socmed')
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
            <div id="13" class="uk-width-1-1"></div>
            <div id="14" class="uk-width-1-1">
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
                            <div class="uk-overflow-auto"><table id="convoTable" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table></div>
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

    <script src="{!! asset('assets/js/charts/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/tableInfluencers.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/tableConvo.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoInstagram.js') !!}"></script>

    <script>
        $(document).ready(function() {
            var influencers = ["topLoveIG","topCommentIG","topViewIG"];
            var $userId = '{!! \Auth::user()->id !!}';
            var $startDate = '{!! $startDate !!}';
            var $endDate = '{!! $endDate !!}';
            var $sentiments = '{!! $submittedSentiments !!}';
            var $text = '{!! $searchText !!}';
            // var sdateval = moment.parseZone($startDate).local().format('DD/MM/YY HH:mm');
            // var edateval = moment.parseZone($endDate).local().format('DD/MM/YY HH:mm');
            // $('input[name="startDate"]').val(sdateval);
            // $('input[name="endDate"]').val(edateval);

            var $chartData = {
                "_token": token,
                "userId": $userId,
                "startDate": $startDate,
                "endDate": $endDate,
                "sentiments": $sentiments,
                "text": $text,
                "idMedia": 7,
                "reportType": 2,
                "createTicketUrl": '{!! url('convo/create-ticket') !!}',
                "changeSentimentUrl": '{!! url('change-sentiment') !!}',
                "ticketTypes": '{!! $ticketTypes !!}',
                'users': '{!! $users !!}'
            };

            chartTrendCombo('01', baseUrl + '/charts/trend-sentiment', $chartData);
            chartTrend('02', baseUrl + '/charts/trend-post', $chartData);
            chartTrend('03', baseUrl + '/charts/trend-comment', $chartData);
            chartTrend('04', baseUrl + '/charts/trend-love', $chartData);
            chartTrend('05', baseUrl + '/charts/trend-potential-reach', $chartData);
            chartPie('06', baseUrl + '/charts/pie-post', $chartData);
            chartPie('07', baseUrl + '/charts/pie-love', $chartData);
            chartPie('08', baseUrl + '/charts/pie-comment', $chartData);
            chartPie('09', baseUrl + '/charts/pie-view', $chartData);
            chartBarStack('10', baseUrl + '/charts/bar-sentiment', $chartData);
            chartBar('11', baseUrl + '/charts/bar-interaction-rate', $chartData);
            wordcloud('12', baseUrl + '/charts/wordcloud', $chartData);
            tableInfluencers('13', baseUrl + '/charts/influencer', $chartData, influencers);

            tableConvo('convoTable', baseUrl + '/charts/paging-convo', $chartData);
        });
    </script>
@endsection

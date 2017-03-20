@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-socmed')
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
            <div id="11" class="uk-width-1-1"></div>
            <div id="12" class="uk-width-1-1"></div>
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
    <script src="{!! asset('assets/js/datatables/extensions/pdfmake.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/extensions/vfs_fonts.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jqcloud.js') !!}"></script>

    <script src="{!! asset('assets/js/charts/chartBubble.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartBar.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartTrend.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartPie.js') !!}"></script>
    {{-- <script src="{!! asset('assets/js/charts/chartOntology.js') !!}"></script> --}}
    <script src="{!! asset('assets/js/charts/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/tableInfluencers.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/tableConvo.js') !!}"></script>

    {{-- Post Trend	Post Pie	Sentiment Bar	Wordclouds
    Sentiment Trend	Comment Pie	Interaction Rate Bar	Influencer (Top Status, Top Photo, Top Link, Top Video)
    Fans Trend	Like Pie		Conversation
    	Share Pie		 --}}
    <script>
        $(document).ready(function() {
            var influencers = ["topStatusFB", "topPhotoFB", "topLinkFB", "topVideoFB"];
            var $userId = '{!! \Auth::user()->id !!}';
            var $startDate = '{!! $startDate !!}';
            var $endDate = '{!! $endDate !!}';
            var $sentiments = '{!! $submittedSentiments !!}';
            var $text = '{!! $searchText !!}';

            var $chartData = {
                "_token": token,
                "userId": $userId,
                "startDate": $startDate,
                "endDate": $endDate,
                "sentiments": $sentiments,
                "text": $text,
                "idMedia": 1,
                "reportType": 2
            };

            // chartTrendCombo('01', baseUrl+'/json/charts/113-trend-sentiment.json');
            chartTrendCombo('01', baseUrl + '/charts/trend-sentiment', $chartData);

            // chartTrend('02',baseUrl+'/json/charts/101-trend-post.json');
            chartTrend('02', baseUrl + '/charts/trend-post', $chartData);

            // chartTrend('03',baseUrl+'/json/charts/110-trend-fans.json');
            chartTrend('03', baseUrl + '/charts/trend-fans', $chartData);

            // chartPie('04',baseUrl+'/json/charts/201-pie-post.json');
            chartPie('04', baseUrl + '/charts/pie-post', $chartData);

            // chartPie('05',baseUrl+'/json/charts/203-pie-comment.json');
            chartPie('05', baseUrl + '/charts/pie-comment', $chartData);

            // chartPie('06',baseUrl+'/json/charts/207-pie-like.json');
            chartPie('06', baseUrl + '/charts/pie-like', $chartData);

            // chartPie('07',baseUrl+'/json/charts/210-pie-share.json');
            chartPie('07', baseUrl + '/charts/pie-share', $chartData);

            // chartBarStack('08',baseUrl+'/json/charts/305-bar-sentiment.json');
            chartBarStack('08', baseUrl + '/charts/bar-sentiment', $chartData);

            // chartBar('09',baseUrl+'/json/charts/303-bar-interaction-rate.json');
            chartBar('09', baseUrl + '/charts/bar-interaction-rate', $chartData);

            // wordcloud('10',baseUrl+'/json/charts/403-wordcloud.json');
            wordcloud('10', baseUrl + '/charts/wordcloud', $chartData);

            // tableInfluencers('11', influencers);
            tableInfluencers('11', baseUrl + '/charts/influencer', $chartData, influencers);

            // tableConvo('12',baseUrl+'/json/charts/405-table-convo.json');
            tableConvo('12', baseUrl + '/charts/convo', $chartData);
        });
    </script>
@endsection

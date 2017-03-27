@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
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
            <div id="07" class="uk-width-1-1"></div>
            <div id="08" class="uk-width-1-1"></div>
            <div id="09" class="uk-width-1-1"></div>
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

    <script src="{!! asset('assets/js/charts/chartBubble.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartBar.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartTrend.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartPie.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartOntology.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/tableInfluencers.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/tableConvo.js') !!}"></script>

    <script>

        $(document).ready(function() {
            var influencers = ["top10Forum"];
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
                "idMedia": 6,
                "reportType": 1
            };

            // chartTrendCombo('01',baseUrl+'/json/charts/113-trend-sentiment.json');
            chartTrendCombo('01', baseUrl + '/charts/trend-sentiment', $chartData);

            // chartTrend('02',baseUrl+'/json/charts/101-trend-post.json');
            chartTrend('02', baseUrl + '/charts/trend-post', $chartData);

            // chartTrend('03',baseUrl+'/json/charts/103-trend-comment.json');
            chartTrend('03', baseUrl + '/charts/trend-comment', $chartData);

            // chartBarStack('04',baseUrl+'/json/charts/305-bar-sentiment.json');
            chartBarStack('04', baseUrl + '/charts/bar-sentiment', $chartData);

            // chartBarStack('05',baseUrl+'/json/charts/308-bar-topic-distribution.json');
            chartBarStack('05', baseUrl + '/charts/bar-topic-distribution', $chartData);

            // wordcloud('06',baseUrl+'/json/charts/403-wordcloud.json');
            wordcloud('06', baseUrl + '/charts/wordcloud', $chartData);

            chartOntology('07', baseUrl + '/charts/ontologi', $chartData);
            tableInfluencers('08', baseUrl + '/charts/influencer', $chartData, influencers);
            tableConvo('09', baseUrl + '/charts/convo', $chartData);
        });
    </script>
@endsection

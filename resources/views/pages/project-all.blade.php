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
            <div id="18" class="uk-width-1-1"></div>
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
    <script src="{!! asset('assets/js/charts/chartOntology.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/tableInfluencers.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/tableConvoAll.js') !!}"></script>
    <script>
        //var influencers = ["topStatusFB", "topPhotoFB", "topLinkFB", "topVideoFB"];
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
                "reportType": 1
            };

            chartBubble('01', baseUrl + '/charts/brand-equity', $chartData);

            chartBarStack('02', baseUrl + '/charts/bar-sentiment', $chartData);

            // chartTrendCombo('03',baseUrl+'/json/charts/113-trend-sentiment.json');
            chartTrendCombo('03', baseUrl + '/charts/trend-sentiment', $chartData);

            //chartTrend('04', baseUrl+'/json/charts/101-trend-post.json');
            chartTrend('04', baseUrl + '/charts/trend-post', $chartData);

            //chartTrend('05', baseUrl+'/json/charts/102-trend-buzz.json');
            chartTrend('05', baseUrl + '/charts/trend-buzz', $chartData);

            //chartTrend('06', baseUrl+'/json/charts/106-trend-reach.json');
            chartTrend('06', baseUrl + '/charts/trend-reach', $chartData);

            //chartTrend('07', baseUrl+'/json/charts/104-trend-interaction.json');
            chartTrend('07', baseUrl + '/charts/trend-interaction', $chartData);

            // chartPie('08',baseUrl+'/json/charts/201-pie-post.json');
            chartPie('08', baseUrl + '/charts/pie-post', $chartData);

            // chartPie('09',baseUrl+'/json/charts/202-pie-buzz.json');
            chartPie('09', baseUrl + '/charts/pie-buzz', $chartData);

            // chartPie('10',baseUrl+'/json/charts/204-pie-interaction.json');
            chartPie('10', baseUrl + '/charts/pie-interaction', $chartData);

            // chartPie('11',baseUrl+'/json/charts/211-pie-unique-user.json');
            chartPie('11', baseUrl + '/charts/pie-unique-user', $chartData);

            // chartBar('12', baseUrl + '/json/charts/303-bar-interaction-rate.json');
            chartBar('12', baseUrl + '/charts/bar-interaction-rate', $chartData);

            // chartBarStack('13', baseUrl + '/json/charts/306-bar-media-share.json');
            chartBarStack('13', baseUrl + '/charts/bar-media-share', $chartData);

            // chartBarStack('14', baseUrl + '/json/charts/308-bar-topic-distribution.json');
            chartBarStack('14', baseUrl + '/charts/bar-topic-distribution', $chartData);

            // chartOntology('15', baseUrl+'/json/charts/402-ontology.json');
            chartOntology('15', baseUrl + '/charts/ontologi', $chartData);

            // wordcloud('16',baseUrl+'/json/charts/403-wordcloud.json');
            wordcloud('16', baseUrl + '/charts/wordcloud', $chartData);

            //tableInfluencers('17',influencers);
            // tableConvoAll('17',baseUrl+'/json/charts/405-table-convo.json');
            tableConvoAll('17', baseUrl + '/charts/convo', $chartData);
        });
    </script>
@endsection
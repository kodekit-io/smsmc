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
            <div id="11" class="uk-width-1-1"></div>
            <div id="12" class="uk-width-1-1"></div>
            <div id="13" class="uk-width-1-1"></div>
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
    <script src="{!! asset('assets/js/charts/convoFacebook.js') !!}"></script>
    <script>
        $(document).ready(function() {
            var influencers = ["topStatusFB", "topPhotoFB", "topLinkFB", "topVideoFB"];
            var $projectId = '{!! $projectId !!}';
            var $startDate = '{!! $startDate !!}';
            var $endDate = '{!! $endDate !!}';
            var $keywords = '{!! $submittedKeywords !!}';
            var $topics = '{!! $submittedTopics !!}';
            var $sentiments = '{!! $submittedSentiments !!}';
            var $text = '{!! $searchText !!}';
            var $ticketTypes = jQuery.parseJSON('{!! $ticketTypes !!}');
            console.log($ticketTypes);

            var $chartData = {
                "baseUrl": baseUrl,
                "_token": token,
                "projectId": $projectId,
                "startDate": $startDate,
                "endDate": $endDate,
                "keywords": $keywords,
                "topics": $topics,
                "sentiments": $sentiments,
                "text": $text,
                "idMedia": 1,
                "reportType": 1,
                "ticketTypes": $ticketTypes
            };

            chartTrendCombo('01', baseUrl + '/charts/trend-sentiment', $chartData);
            chartTrend('02', baseUrl + '/charts/trend-post', $chartData);
            chartPie('03', baseUrl + '/charts/pie-post', $chartData);
            chartPie('04', baseUrl + '/charts/pie-comment', $chartData);
            chartPie('05', baseUrl + '/charts/pie-like', $chartData);
            chartPie('06', baseUrl + '/charts/pie-share', $chartData);
            chartBarStack('07', baseUrl + '/charts/bar-sentiment', $chartData);
            chartBar('08', baseUrl + '/charts/bar-interaction-rate', $chartData);
            chartBarStack('09', baseUrl + '/charts/bar-topic-distribution', $chartData);
            wordcloud('10', baseUrl + '/charts/wordcloud', $chartData);
            chartOntology('11', baseUrl + '/charts/ontologi', $chartData);
            tableInfluencers('12', baseUrl + '/charts/influencer', $chartData, influencers);
            tableConvo('13', baseUrl + '/charts/convo', $chartData);
        });
    </script>
@endsection

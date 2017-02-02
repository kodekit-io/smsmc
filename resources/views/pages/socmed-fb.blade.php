@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/dataTables.smsmc.css') !!}" />
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
            <div id="11"></div>
            <div id="12"></div>
            <div id="13" class="uk-width-1-1"></div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script>
    $(document).ready(function() {
        chart113('01');
        trendSample('02','sentimentTrend','Sentiment Trend');
        trendSample('03','postTrend','Post Trend');
        trendSample('04','fansTrend','Fans Trend');

        pieSample('05','postPie','Post');
        pieSample('06','commentPie','Comment');
        pieSample('07','likePie','Like');
        pieSample('08','sharePie','Share');

        barSample('09','commnetInteraction','Comment Interaction');
        barSample('10','topicBar','Topic Distributions');

        ontologySample('11','ontology','Ontology');
        wordCloudSample('12','wordCloud','Word Cloud');
        convoSample('13','convo','Conversation');
    });

    </script>
    <script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/extension/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>

    <script src="{!! asset('assets/js/charts/113-sentiment.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/trend-sample.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/pie-sample.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/bar-sample.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/ontology-sample.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/wordcloud-sample.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convo-sample.js') !!}"></script>
@endsection
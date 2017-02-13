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
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script>
    $(document).ready(function() {
        chart401('01');
        chart113('02');
        trendSample('03','postTrend','Post Trend');
        trendSample('04','buzzTrend','Buzz Trend');
        trendSample('05','reachTrend','Reach Trend');
        trendSample('06','interactionTrend','Interaction Trend');
        trendSample('07','sentimentTrend','Sentiment Trend');
        pieSample('08','postPie','Post');
        pieSample('09','buzzPie','Buzz');
        pieSample('10','interactionPie','Interaction');
        pieSample('11','uniqueUserPie','Unique User');
        barSample('12','interactionBar','Interaction Rate');
        barSample('13','shareMediaBar','Share of Media');
        barSample('14','topicBar','Topic Distributions');
        ontologySample('15','ontology','Ontology');
        wordCloudSample('16','wordCloud','Word Cloud');
        convoSample('17','convo','Conversation');
    });

    </script>
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

    <script src="{!! asset('assets/js/charts/401-brandEquity.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/113-sentiment.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/trend-sample.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/pie-sample.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/bar-sample.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/ontology-sample.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/wordcloud-sample.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convo-sample.js') !!}"></script>
@endsection
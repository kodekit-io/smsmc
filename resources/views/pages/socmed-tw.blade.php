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
            <div id="11"></div>
            <div id="12"></div>
            <div id="13" class="uk-width-1-1"></div>
            <div id="14" class="uk-width-1-1"></div>
            <div id="15" class="uk-width-1-1"></div>
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
    {{-- Buzz Trend	Buzz Pie	Sentiment Bar	Wordclouds
    User Trend	Interactions Pie	Interaction Rate Bar	Influencer (Top Reach, Top Post, Top Impact)
    Reach Trend	Post Pie		Conversation
    Sentiment Trend	Potential Reach Pie		 --}}
    <script>
        var influencers = ["top10ByReachTW", "top10ByNumberTW", "top10ByImpactTW"];
        $(document).ready(function() {
            chartTrendCombo('01',baseUrl+'/json/charts/113-trend-sentiment.json');
            chartTrend('02',baseUrl+'/json/charts/102-trend-buzz.json');
            chartTrend('03',baseUrl+'/json/charts/111-trend-user.json');
            chartTrend('04',baseUrl+'/json/charts/106-trend-reach.json');

            chartPie('05',baseUrl+'/json/charts/202-pie-buzz.json');
            chartPie('06',baseUrl+'/json/charts/204-pie-interaction.json');
            chartPie('07',baseUrl+'/json/charts/214-pie-viral-reach.json');
            chartPie('08',baseUrl+'/json/charts/205-pie-potential-reach.json');

            chartBarStack('09',baseUrl+'/json/charts/305-bar-sentiment.json');
            chartBar('10',baseUrl+'/json/charts/303-bar-interaction-rate.json');
            chartBarStack('11',baseUrl+'/json/charts/308-bar-topic-distribution.json');

            wordcloud('12',baseUrl+'/json/charts/403-wordcloud.json');
            tableInfluencers('14',influencers);
            tableConvo('15',baseUrl+'/json/charts/405-table-convo.json');
        });
    </script>
@endsection
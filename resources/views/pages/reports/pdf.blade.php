@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
    <div class="uk-card uk-card-secondary uk-card-body" style="padding:5px 20px;">
        <div class="uk-flex uk-flex-middle">
            <form method="post" action="" class="uk-width-expand">
                {!! csrf_field() !!}
                <div class="uk-flex uk-flex-middle">
                    <div class="uk-width-auto@m">
                        <div class="uk-inline sm-text-bold">Choose Project :</div>
                        <div class="uk-inline">
                            <select name="projectId" id="projectId" class="uk-select uk-form-small">
                                @if(count($projects) > 0)
                                    @foreach($projects as $project)
                                        <option value="{{ $project->pid }}">{{ $project->pname }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="uk-width-auto@m uk-margin-left">
                        <div class="uk-inline sm-text-bold">Date Range:</div>
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                            <input type="text" class="datetimepicker uk-input uk-form-small uk-width-small" name="startDate" aria-describedby="option-startDate" value="{!! $shownStartDate !!}">
                        </div>
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                            <input type="text" class="datetimepicker uk-input uk-form-small uk-width-small" name="endDate" aria-describedby="option-endDate" value="{!! $shownEndDate !!}">
                        </div>
                    </div>
                    <div class="uk-width-auto@m uk-margin-left">
                        <button class="uk-button uk-button-small white-text red darken-1" name="filter" type="submit" value="filter">UPDATE PREVIEW</button>
                    </div>
                </div>
            </form>
            <form method="post" action="{!! url('report/download-pdf') !!}" class="uk-width-auto" id="report-form">
		        {!! csrf_field() !!}
                <input type="hidden" name="reportStart" value="{{ $shownStartDate }}">
                <input type="hidden" name="reportEnd" value="{{ $shownEndDate }}">
		        <input type="submit" value="CREATE PDF" class="uk-button uk-button-primary" />
		    </form>
        </div>
    </div>
@endsection
@section('content')

    <section class="uk-container uk-container-expand uk-padding-small uk-padding-remove-top">
        <div class="uk-grid-small uk-child-width-1-4@m " uk-grid uk-sortable="handle: .uk-card-header">
            <div id="brandEquity"></div>
            <div id="sentiment"></div>
            <div id="sentimentTrend"></div>
            <div id="postTrend"></div>

            <div id="buzzTrend"></div>
            <div id="reachTrend"></div>
            <div id="intTrend"></div>
            <div id="postPie"></div>

            <div id="buzzPie"></div>
            <div id="intPie"></div>
            <div id="uniqueUser"></div>
            <div id="intRate"></div>

            <div id="som"></div>
            <div id="topicDist"></div>
            <div id="ontology"></div>
            <div id="wordcloud"></div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/extension/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jqcloud.js') !!}"></script>



    <script src="{!! asset('assets/js/reports/chartBubble.js') !!}"></script>
    <script src="{!! asset('assets/js/reports/chartBar.js') !!}"></script>
    <script src="{!! asset('assets/js/reports/chartTrend.js') !!}"></script>
    <script src="{!! asset('assets/js/reports/chartPie.js') !!}"></script>
    <script src="{!! asset('assets/js/reports/chartOntology.js') !!}"></script>
    <script src="{!! asset('assets/js/reports/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/reports/tableInfluencers.js') !!}"></script>

    <script>
        $(document).ready(function() {
            var $projectId = '{!! $projectId !!}';
            var $startDate = '{!! $startDate !!}';
            var $endDate = '{!! $endDate !!}';
            var sdateval = moment.parseZone($startDate).local().format('DD/MM/YY HH:mm');
            var edateval = moment.parseZone($endDate).local().format('DD/MM/YY HH:mm');
            $('input[name="startDate"]').val(sdateval);
            $('input[name="endDate"]').val(edateval);

            var $chartData = {
                "_token": token,
                "projectId": $projectId,
                "startDate": $startDate,
                "endDate": $endDate,
                "idMedia": 8,
                "reportType": 1
            };

            if ($projectId != '') {
                chartBubble('brandEquity', baseUrl + '/charts/brand-equity', $chartData);
                chartBarStack('sentiment', baseUrl + '/charts/bar-sentiment', $chartData);
                chartTrendCombo('sentimentTrend', baseUrl + '/charts/trend-sentiment', $chartData);
                chartTrend('postTrend', baseUrl + '/charts/trend-post', $chartData);
                chartTrend('buzzTrend', baseUrl + '/charts/trend-buzz', $chartData);
                chartTrend('reachTrend', baseUrl + '/charts/trend-reach', $chartData);
                chartTrend('intTrend', baseUrl + '/charts/trend-interaction', $chartData);
                chartPie('postPie', baseUrl + '/charts/pie-post', $chartData);
                chartPie('buzzPie', baseUrl + '/charts/pie-buzz', $chartData);
                chartPie('intPie', baseUrl + '/charts/pie-interaction', $chartData);
                chartPie('uniqueUser', baseUrl + '/charts/pie-unique-user', $chartData);
                chartBar('intRate', baseUrl + '/charts/bar-interaction-rate', $chartData, 'Interaction Rate');
                chartBarStack('som', baseUrl + '/charts/bar-media-share', $chartData);
                chartBarStack('topicDist', baseUrl + '/charts/bar-topic-distribution', $chartData);
                chartOntology('ontology', baseUrl + '/charts/ontologi', $chartData);
                wordcloud('wordcloud', baseUrl + '/charts/wordcloud', $chartData);
            }

            $.ajax({
                url: baseUrl + "/charts/download-convo-all",
                method: "POST",
                data: $chartData
            }).done(function (downloadLink) {
                //console.log(downloadLink);
                var btnExcel = '<li><a class="uk-button uk-button-small green darken-2 white-text" href="'+downloadLink+'" id="download_excel" target="_blank" title="Export All Media Conversations to Excel" uk-tooltip>EXPORT ALL CONVERSATIONS</a></li>';
                $('div#405').find('.uk-card-body').append(btnExcel);
            });

        });
    </script>
@endsection

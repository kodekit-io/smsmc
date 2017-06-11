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
                            <select name="" id="" class="uk-select uk-form-small">
                                <option value="">Project 1</option>
                                <option value="">Project 2</option>
                                <option value="">Project 3</option>
                                <option value="">Project 4</option>
                                <option value="">Project 5</option>
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
            <form method="post" action="{!! url('tests/echarts/post') !!}" class="uk-width-auto">
		        {!! csrf_field() !!}
		        <input type="hidden" name="chart1" value="" id="chart1">
		        <input type="submit" value="CREATE PDF" class="uk-button uk-button-primary" />
		    </form>
        </div>
    </div>
@endsection
@section('content')

    <section class="uk-container uk-container-expand uk-padding-small uk-padding-remove-top">
        <div class="uk-grid-small uk-child-width-1-4@m " uk-grid uk-sortable="handle: .uk-card-header">
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

    <script src="{!! asset('assets/js/charts/chartBubble.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartBar.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartTrend.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartPie.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartOntology.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/tableInfluencers.js') !!}"></script>

    <script src="{!! asset('assets/js/charts/tableConvo.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoFacebook.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoTwitter.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoNews.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoBlog.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoForum.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoVideo.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/convoInstagram.js') !!}"></script>

    <script>
        $(document).ready(function() {
            var $projectId = '{!! $projectId !!}';
            var $startDate = '{!! $startDate !!}';
            var $endDate = '{!! $endDate !!}';
            var $keywords = '{!! $submittedKeywords !!}';
            var $topics = '{!! $submittedTopics !!}';
            var $sentiments = '{!! $submittedSentiments !!}';
            var $text = '{!! $searchText !!}';
            var sdateval = moment.parseZone($startDate).local().format('DD/MM/YY HH:mm');
            var edateval = moment.parseZone($endDate).local().format('DD/MM/YY HH:mm');
            $('input[name="startDate"]').val(sdateval);
            $('input[name="endDate"]').val(edateval);

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
                "reportType": 1,
                "createTicketUrl": '{!! url('convo/create-ticket') !!}',
                "changeSentimentUrl": '{!! url('change-sentiment') !!}',
                "ticketTypes": '{!! $ticketTypes !!}',
                'users': '{!! $users !!}'
            };

            chartBubble('01', baseUrl + '/charts/brand-equity', $chartData);
            chartBarStack('02', baseUrl + '/charts/bar-sentiment', $chartData);
            chartTrendCombo('03', baseUrl + '/charts/trend-sentiment', $chartData);
            chartTrend('04', baseUrl + '/charts/trend-post', $chartData);
            chartTrend('05', baseUrl + '/charts/trend-buzz', $chartData);
            chartTrend('06', baseUrl + '/charts/trend-reach', $chartData);
            chartTrend('07', baseUrl + '/charts/trend-interaction', $chartData);
            chartPie('08', baseUrl + '/charts/pie-post', $chartData);
            chartPie('09', baseUrl + '/charts/pie-buzz', $chartData);
            chartPie('10', baseUrl + '/charts/pie-interaction', $chartData);
            chartPie('11', baseUrl + '/charts/pie-unique-user', $chartData);
            chartBar('12', baseUrl + '/charts/bar-interaction-rate', $chartData, 'Interaction Rate');
            chartBarStack('13', baseUrl + '/charts/bar-media-share', $chartData);
            chartBarStack('14', baseUrl + '/charts/bar-topic-distribution', $chartData);
            chartOntology('15', baseUrl + '/charts/ontologi', $chartData);
            wordcloud('16', baseUrl + '/charts/wordcloud', $chartData);

        	tableConvo('convoFacebook', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 1);
            tableConvo('convoTwitter', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 2);
            tableConvo('convoNews', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 4);
            tableConvo('convoNewsInt', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 9);
            tableConvo('convoBlog', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 3);
            tableConvo('convoForum', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 6);
            tableConvo('convoVideo', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 5);
            tableConvo('convoInstagram', baseUrl + '/charts/paging-convo', $chartData, idMediaParam = 7);

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

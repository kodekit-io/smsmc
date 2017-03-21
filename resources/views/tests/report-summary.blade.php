@extends('layouts.export')
@section('page-level-styles')
@endsection
@section('content')
	<form method="post" action="{!! url('tests/echarts/post') !!}">
        {!! csrf_field() !!}
        <input type="hidden" name="chart1" value="" id="chart1">
        <input type="submit" value="Submit" />
    </form>
	<page size="A4" layout="portrait">
		<div class="page-margin">
			<div class="uk-grid-small uk-child-width-1-2" uk-grid>
				<div id="01"></div>
				<div id="02"></div>
				<div id="03"></div>
				<div id="04"></div>
			</div>
		</div>
	</page>
@endsection

@section('page-level-scripts')

	<script src="{!! asset('assets/js/charts/chartBubble.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartBar.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartTrend.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/chartPie.js') !!}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var $projectId = '94941412017';
            var $startDate = '2017-03-14T00:00:01Z';
            var $endDate = '2017-03-21T09:53:02Z';
            var $keywords = '';
            var $topics = '';
            var $sentiments = '1,0,-1';
            var $text = '';
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
		    var baseUrl = "{!! url('/') !!}";
		    chartBubble('01', baseUrl + '/charts/brand-equity', $chartData);
			chartBarStack('02', baseUrl + '/charts/bar-sentiment', $chartData);
			chartTrend('03', baseUrl + '/charts/trend-post', $chartData);
			chartPie('04', baseUrl + '/charts/pie-unique-user', $chartData);
		});
	</script>
@endsection

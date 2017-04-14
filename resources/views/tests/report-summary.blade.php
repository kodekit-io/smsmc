@extends('layouts.export')
@section('page-level-styles')
@endsection
@section('page-level-nav')
@endsection
@section('content')

	<section class="sm-main sm-nosubnav uk-container uk-container-expand">
		<div class="uk-card uk-card-default uk-card-small uk-card-body uk-width-1-1 uk-margin-bottom">
			<form method="post" action="{!! url('tests/echarts/post') !!}">
		        {!! csrf_field() !!}
		        <input type="hidden" name="chart1" value="" id="chart1">
		        <input type="submit" value="Submit" class="uk-button uk-button-default" />
		    </form>
		</div>
		<page size="A4" layout="portrait">
			<div class="page-margin">
				<div class="uk-grid-small uk-child-width-1-2" uk-grid>
					<div id="01"></div>
				</div>
			</div>
		</page>
	</section>
@endsection

@section('page-level-scripts')
	<script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
	<script src="{!! asset('assets/js/report/brandEquity.js') !!}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    var baseUrl = "{!! url('/') !!}";
            var $projectId = '1022492332017';
            var $startDate = '2017-04-01T00:00:01Z';
            var $endDate = '2017-04-10T23:59:59Z';

            var $chartData = {
                "_token": token,
                "projectId": $projectId,
                "startDate": $startDate,
                "endDate": $endDate
            };

			brandEquity('01', baseUrl + '/charts/brand-equity', $chartData);

        });
	</script>
@endsection

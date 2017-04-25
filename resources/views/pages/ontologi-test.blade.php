@extends('layouts.default')
@section('page-level-styles')
    <style>
        .sm-chart {
            min-height: calc(100vh - 150px - 60px - 37px - 30px);
        }
    </style>
@endsection
@section('page-level-nav')
    @include('includes.subnav-project')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-grid-medium uk-child-width-1-1" uk-grid uk-sortable="handle: .uk-card-header">
            <div id="01"></div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script>
        function chartOntology(domId,url,chartApiData,name) {
            $.ajax({
                method: "POST",
                url: url,
                data: chartApiData,
                beforeSend : function(xhr) {
                    $('#'+domId).append(cardloader);
                },
                complete : function(xhr, status) {
                    $('.cardloader').remove();
                },
                success: function(result){
                    if (result[0]===undefined) {
                        $('#'+domId).html(cardEmpty);
                    }
                    var result = jQuery.parseJSON(result);
                    var chartId = result.chartId;
                    var chartName = result.chartName;
                    var chartInfo = result.chartInfo;
                    if (name != null) {
                        var chartTitle = name;
                    } else {
                        var chartTitle = chartName;
                    }

                    var card = '<div class="sm-chart-container uk-animation-fade">'
                        + '<div class="uk-card uk-card-hover uk-card-default uk-card-small">'
                            + '<div class="uk-card-header uk-clearfix">'
                                + '<h5 class="uk-card-title uk-float-left">'+chartTitle+'</h5>'
                                + '<ul class="uk-float-right uk-subnav uk-margin-remove">'
                                    + '<li><a class="grey-text fa fa-info-circle" title="'+chartInfo+'" uk-tooltip></a></li>'
                                    + '<li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>'
                                    + '<li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>'
                                + '</ul>'
                            + '</div>'
                            + '<div class="uk-card-body">'
                                + '<div id="'+chartId+'" class="sm-chart"></div>'
                            + '</div>'
                        + '</div>'
                    + '</div>';
                    $('#'+domId).append(card);

                    var data = result.nodes;
                    if (data.length > 0) {
                        //CHART
                        var domchart = document.getElementById(chartId);
                        var theme = 'default';
                        var theChart = echarts.init(domchart);
                        var loadingTicket;
                        var effectIndex = -1;
                        var effect = ['spin'];

                        theChart.showLoading({
                            text : '',
                        });

                        var serie=[];
                        for (var i = 0; i < data.length; i++) {
    						serie[i] = {
    	                        name: data[i].name,
    	                        value: data[i].value,
    	                        category: data[i].category,
    	                        node: data[i].node
    	                    }
                        }
                        var option = {
                            legend: {
                                data: result.categories,
                                x: 'left',
                                y: 'bottom',
                            },
                            grid: {
                                x: 0,
                                x2: 0,
                                y: 0,
                                y2: 0
                            },
                            tooltip: {
                                trigger: 'item',
                            },
                            toolbox: {
                                show: true,
                                x: 'right',
                                y: 'bottom',
                                padding: ['0', '0', '0', '0'],
                                feature: {
                                    mark: {
                                        show: true
                                    },
                                    restore: {show: true, title: 'Reload'},
                                    saveAsImage: {show: true, title: 'Save'}
                                }
                            },
                            series: [{
                                type: 'graph',
                                layout: 'force',
                                roam: true,
                                animation: true,
                                label: {
                                    normal: {
                                        show: true,
                                        position: 'right',
                                        formatter: '{b}'
                                    }
                                },
                                draggable: true,
                                data: result.nodes.map(function (node, idx) {
                                    node.id = idx;
                                    return node;
                                }),
        						// data: serie,
                                categories: result.categories,
                                force: {
                                    repulsion: 50,
                                    gravity: 0.1,
                                    edgeLength: 30,
                                    layoutAnimation: false,
                                },
                                edges: result.links,
                                itemStyle: {},
                            }]

                        };
                        clearTimeout(loadingTicket);
                        loadingTicket = setTimeout(function (){
                            theChart.hideLoading();
                            theChart.setOption(option);
                            theChart.resize();
                        },1200);
                        $(window).on('resize', function(){
                            if(theChart != null && theChart != undefined){
                                theChart.resize();
                            }
                        });

                    } else {
                        $('#'+chartId).html(msgEmpty);
                    }
                },
                error: function(xhr, status){
                    $('#'+domId).html(cardEmpty);
                }
            });

        }


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
                "reportType": 1,
                "createTicketUrl": '{!! url('convo/create-ticket') !!}',
                "changeSentimentUrl": '{!! url('change-sentiment') !!}',
                "ticketTypes": '{!! $ticketTypes !!}',
                'users': '{!! $users !!}'
            };

            chartOntology('01', baseUrl + '/charts/ontologi', $chartData);

        });
    </script>
@endsection

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
        <div class="uk-grid-medium uk-child-width-1-2" uk-grid uk-sortable="handle: .uk-card-header">
            <div id="01"></div>
            <div id="02"></div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script>
    // $.ajax({
    //     // method: "POST",
    //     url: baseUrl+'/json/charts/402-ontology.json',
    //     // data: chartApiData,
    //     beforeSend : function(xhr) {
    //         // $('#'+domId).append(cardloader);
    //     },
    //     complete : function(xhr, status) {
    //         // $('#'+domId+' .cardloader').remove();
    //     },
    //     success: function(result){
    //         // console.log(result);
    //         // myChart.hideLoading();
    //         var domchart = document.getElementById('01');
    //         var theme = 'default';
    //         var myChart = echarts.init(domchart);
    //
    //         var graph = result;
    //         var categories = graph.categories;
    //
    //         var option = {
    //             tooltip: {},
    //             color: categories.map(function (c) {
    //                     return c.color;
    //                 }),
    //             legend: [{
    //                 data: categories.map(function (a) {
    //                     return a.name;
    //                 })
    //             }],
    //             animationDuration: 1500,
    //             animationEasingUpdate: 'quinticInOut',
    //             series : [
    //                 {
    //                     name: graph.chartName,
    //                     type: 'graph',
    //                     layout: graph.type,
    //                     force: {
    //                         repulsion: 100,
    //                         gravity: 0.1,
    //                         edgeLength: 50,
    //                         layoutAnimation: true,
    //                     },
    //                     // data: graph.nodes,
    //                     data: graph.nodes.map(function (node) {
    //                         return {
    //                             id: node.name,
    //                             name: node.name,
    //                             symbolSize: node.value,
    //                             value: node.value,
    //                             category: node.category,
    //                         };
    //                     }),
    //                     // links: graph.links,
    //                     links: graph.links.map(function (link) {
    //                         return {
    //                             source: link.source,
    //                             target: link.target,
    //                             lineStyle: {
    //                                 normal: {
    //                                     color: link.sentiment,
    //                                     curveness: 0.3,
    //                                     width: 2
    //                                 }
    //                             }
    //                         };
    //                     }),
    //                     categories: categories,
    //                     roam: true,
    //                     focusNodeAdjacency: true,
    //                     draggable: true,
    //                     label: {
    //                         normal: {
    //                             position: 'right',
    //                             formatter: '{b}'
    //                         }
    //                     }
    //                 }
    //             ]
    //         };
    //
    //         myChart.setOption(option);
    //     }
    // });

    function chartOntology(domId,url,chartApiData,name) {
        $.ajax({
            // method: "POST",
            url: url,
            data: chartApiData,
            beforeSend : function(xhr) {
                // $('#'+domId).append(cardloader);
            },
            complete : function(xhr, status) {
                // $('#'+domId+' .cardloader').remove();
            },
            success: function(result){
                // if (result[0]===undefined) {
                //     $('#'+domId).html(cardEmpty);
                // }
                // var result = jQuery.parseJSON(result);
                // console.log(result);
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

                    var graph = result;
                    var categories = graph.categories;

                    // console.log(serie);
                    var option = {
                        tooltip: {},
                        color: categories.map(function (c) {
                                return c.color;
                            }),
                        legend: [{
                            data: categories.map(function (a) {
                                return a.name;
                            })
                        }],
                        animationDuration: 1500,
                        animationEasingUpdate: 'quinticInOut',
                        series : [
                            {
                                name: graph.chartName,
                                type: 'graph',
                                layout: graph.type,
                                force: {
                                    repulsion: 100,
                                    gravity: 0.1,
                                    edgeLength: 50,
                                    layoutAnimation: true,
                                },
                                // data: graph.nodes,
                                data: graph.nodes.map(function (node) {
                                    return {
                                        id: node.name,
                                        name: node.name,
                                        symbolSize: node.value,
                                        value: node.value,
                                        category: node.category,
                                    };
                                }),
                                // links: graph.links,
                                links: graph.links.map(function (link) {
                                    return {
                                        source: link.source,
                                        target: link.target,
                                        lineStyle: {
                                            normal: {
                                                color: link.color,
                                                curveness: 0.3,
                                                width: 2
                                            }
                                        }
                                    };
                                }),
                                categories: categories,
                                roam: true,
                                focusNodeAdjacency: true,
                                draggable: true,
                                label: {
                                    normal: {
                                        position: 'right',
                                        formatter: '{b}'
                                    }
                                }
                            }
                        ]
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
        var influencers = ["topStatusFB", "topPhotoFB", "topLinkFB", "topVideoFB"];
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
            "createTicketUrl": '{!! url('convo/create-ticket') !!}',
            "changeSentimentUrl": '{!! url('change-sentiment') !!}',
            "ticketTypes": '{!! $ticketTypes !!}',
            'users': '{!! $users !!}'
        };
        chartOntology('01', baseUrl + '/json/charts/402-ontology-force.json', $chartData);
        chartOntology('02', baseUrl + '/json/charts/402-ontology-circular.json', $chartData);
    });
    </script>
@endsection

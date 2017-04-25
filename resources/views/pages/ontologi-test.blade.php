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
                    // console.log(result);
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

                        // var serie=[];
                        // for (var i = 0; i < data.length; i++) {
    					// 	serie[i] = {
    	                //         name: data[i].name,
    	                //         value: data[i].value,
    	                //         category: data[i].category,
    	                //         node: data[i].node
    	                //     }
                        // }


                        var option = {
                            legend: {
                                data: [
                                    {
                                        "name": "Pajero"
                                    },
                                    {
                                        "name": "forturner"
                                    },
                                    {
                                        "name": "nissan"
                                    },
                                    {
                                        "name": "cr-v"
                                    },
                                    {
                                        "name": "freed"
                                    },
                                    {
                                        "name": "hr-v"
                                    }
                                ],
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
                                // json datanya
        						data: [
                                    {
                                        "node": 0,
                                        "category": 0,
                                        "name": "Pajero",
                                        "value": 0
                                    },
                                    {
                                        "node": 1,
                                        "category": 1,
                                        "name": "forturner",
                                        "value": 0
                                    },
                                    {
                                        "node": 2,
                                        "category": 2,
                                        "name": "nissan",
                                        "value": 0
                                    },
                                    {
                                        "node": 3,
                                        "category": 3,
                                        "name": "cr-v",
                                        "value": 21
                                    },
                                    {
                                        "node": 4,
                                        "category": 4,
                                        "name": "freed",
                                        "value": 0
                                    },
                                    {
                                        "node": 5,
                                        "category": 5,
                                        "name": "hr-v",
                                        "value": 21
                                    },
                                    {
                                        "node": 6,
                                        "category": 3,
                                        "name": "BandarBola8",
                                        "value": 1
                                    },
                                    {
                                        "node": 7,
                                        "category": 3,
                                        "name": "nyerocosss",
                                        "value": 2
                                    },
                                    {
                                        "node": 8,
                                        "category": 3,
                                        "name": "KanalMedia",
                                        "value": 4
                                    },
                                    {
                                        "node": 9,
                                        "category": 3,
                                        "name": "jailangkun9",
                                        "value": 2
                                    },
                                    {
                                        "node": 10,
                                        "category": 3,
                                        "name": "irengguteng",
                                        "value": 2
                                    },
                                    {
                                        "node": 11,
                                        "category": 3,
                                        "name": "abe_ptm",
                                        "value": 1
                                    },
                                    {
                                        "node": 12,
                                        "category": 3,
                                        "name": "infojatim",
                                        "value": 6
                                    },
                                    {
                                        "node": 13,
                                        "category": 3,
                                        "name": "valinobaen",
                                        "value": 1
                                    },
                                    {
                                        "node": 14,
                                        "category": 3,
                                        "name": "puucing",
                                        "value": 1
                                    },
                                    {
                                        "node": 15,
                                        "category": 3,
                                        "name": "21_sakinah",
                                        "value": 1
                                    },
                                    {
                                        "node": 16,
                                        "category": 5,
                                        "name": "dummyuser1",
                                        "value": 1
                                    },
                                    {
                                        "node": 17,
                                        "category": 5,
                                        "name": "dummyuser2",
                                        "value": 1
                                    },
                                    {
                                        "node": 18,
                                        "category": 5,
                                        "name": "dummyuser3",
                                        "value": 1
                                    },
                                    {
                                        "node": 19,
                                        "category": 5,
                                        "name": "dummyuser4",
                                        "value": 1
                                    },
                                    {
                                        "node": 20,
                                        "category": 5,
                                        "name": "dummyuser5",
                                        "value": 1
                                    },
                                    {
                                        "node": 21,
                                        "category": 0,
                                        "name": "dummyuser6",
                                        "value": 10
                                    },
                                    {
                                        "node": 22,
                                        "category": 0,
                                        "name": "dummyuser7",
                                        "value": 15
                                    },
                                    {
                                        "node": 23,
                                        "category": 0,
                                        "name": "dummyuser8",
                                        "value": 11
                                    },
                                    {
                                        "node": 24,
                                        "category": 0,
                                        "name": "dummyuser9",
                                        "value": 18
                                    },
                                    {
                                        "node": 25,
                                        "category": 0,
                                        "name": "dummyuser10",
                                        "value": 12
                                    }
                                ],
                                categories: [
                                    {
                                        "name": "Pajero"
                                    },
                                    {
                                        "name": "forturner"
                                    },
                                    {
                                        "name": "nissan"
                                    },
                                    {
                                        "name": "cr-v"
                                    },
                                    {
                                        "name": "freed"
                                    },
                                    {
                                        "name": "hr-v"
                                    }
                                ],
                                force: {
                                    repulsion: 25,
                                    gravity: 0.01,
                                    edgeLength: 50,
                                    layoutAnimation: false,
                                },
                                // json untuk linknya
                                edges: [
                                    {
                                        "source": 3,
                                        "target": 6
                                    },
                                    {
                                        "source": 3,
                                        "target": 7
                                    },
                                    {
                                        "source": 3,
                                        "target": 8
                                    },
                                    {
                                        "source": 3,
                                        "target": 9
                                    },
                                    {
                                        "source": 3,
                                        "target": 10
                                    },
                                    {
                                        "source": 3,
                                        "target": 11
                                    },
                                    {
                                        "source": 3,
                                        "target": 12
                                    },
                                    {
                                        "source": 3,
                                        "target": 13
                                    },
                                    {
                                        "source": 3,
                                        "target": 14
                                    },
                                    {
                                        "source": 3,
                                        "target": 15
                                    },
                                    {
                                        "source": 5,
                                        "target": 7
                                    },
                                    {
                                        "source": 5,
                                        "target": 8
                                    },
                                    {
                                        "source": 5,
                                        "target": 16
                                    },
                                    {
                                        "source": 5,
                                        "target": 17
                                    },
                                    {
                                        "source": 5,
                                        "target": 18
                                    },
                                    {
                                        "source": 5,
                                        "target": 19
                                    },
                                    {
                                        "source": 5,
                                        "target": 20
                                    },
                                    {
                                        "source": 0,
                                        "target": 21
                                    },
                                    {
                                        "source": 0,
                                        "target": 22
                                    },
                                    {
                                        "source": 0,
                                        "target": 23
                                    },
                                    {
                                        "source": 0,
                                        "target": 24
                                    },
                                    {
                                        "source": 0,
                                        "target": 25
                                    },
                                    {
                                        "source": 3,
                                        "target": 25
                                    },
                                    {
                                        "source": 5,
                                        "target": 25
                                    }
                                ],
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

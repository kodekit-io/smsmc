function chartBar(domId,url,name) {
    $.ajax({
        url: url,
        success: function(result){
            var chartId = result.chartId;
            var chartName = result.chartName;
            var chartInfo = result.chartInfo;
            var chartData = result.chartData;
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

            if (chartData.length === 0) {
                $('#'+chartId).html('<div class="uk-position-center uk-text-center">No Data!</div>');
            } else {
                var data=[],key=[],colors=[];
                for (var i = 0; i < chartData.length; i++) {
                    key[i] = chartData[i].key;
                    data[i] = chartData[i].value;
                    colors[i] = chartData[i].color;
                }
                //console.log(key);
                //CHART
                var domchart = document.getElementById(chartId);
                var theme = 'default';
                var theChart = echarts.init(domchart,theme);
                var loadingTicket;
                var effectIndex = -1;
                var effect = ['spin'];
                theChart.showLoading({
                    text : '',
                });

                var option = {
                    tooltip : {
                        trigger: 'item',
                        formatter: '{b}<br>{a} : {c}'
                    },
                    legend: {
                        show: true,
                        data: [chartName],
                        x: 'left',
                        y: 'bottom'
                    },
                    grid: {
                        x: '30px',
                        x2: '10px',
                        y: '10px',
                        y2: '60px'
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
                            magicType: {
                                show: true,
                                type: ['bar', 'line'],
                                title: {stack: 'Bar', tiled: 'Line'},
                            },
                            restore: {show: true, title: 'Reload'},
                            saveAsImage: {show: true, title: 'Save'}
                        }
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data: key,
                            axisLabel: {
                                textStyle: {
                                    fontSize: 10
                                }
                            }
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value',
                            axisLabel: {
                                textStyle: {
                                    fontSize: 10
                                },
                                formatter: function (v) {
                                    val = numeral(v).format('0.0a');
                                    return val;
                                }
                            },
                        }
                    ],
                    series : {
                        name: chartName,
                        type: 'bar',
                        barMaxWidth: '50%',
                        itemStyle : {
                            normal: {
                                label : {
                                    show: true
                                }
                            }
                        },
                        markLine : {
                            lineStyle: {
                                normal: {
                                    color: '#666'
                                }
                            },
                            data: [
                                {
                                    name: 'Average',
                                    type: 'average'
                                }
                            ]
                        },
                        itemStyle: {
                            normal: {
                                /*color: function(params) {
                                    var colorList = colors;
                                    return colorList[params.dataIndex]
                                },*/
                                label: {
                                    show: true,
                                    position: 'top',
                                    formatter: '{b}\n{c}'
                                }
                            }
                        },
                        data: data
                    }
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
            }
        }
    });
}
function chartBarStack(domId,url,name) {
    var stack = true;
    $.ajax({
        url: url,
        success: function(result){
            var chartId = result.chartId;
            var chartName = result.chartName;
            var chartInfo = result.chartInfo;
            var chartData = result.chartData;
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

            if (chartData.length === 0) {
                $('#'+chartId).html('<div class="uk-position-center uk-text-center">No Data!</div>');
            } else {
                var series=[], legend=[], colors=[], key=[];
                for (var i = 0; i < chartData.length; i++) {
                    legend[i] = chartData[i].name;
                    colors[i] = chartData[i].color;
                    data = chartData[i].data;
                    for (var n = 0; n < data.length; n++) {
                        key[n] = data[n].key;
                    }

                    series[i] = {
                        name: chartData[i].name,
                        type: 'bar',
                        stack: stack,
                        barMaxWidth: '50%',

                        itemStyle : {
                            normal: {
                                label : {
                                    show: true,
                                    position: 'inside',
                                    textStyle: {
                                        fontSize: 10
                                    }
                                }
                            }
                        },
                        data: data
                    }
                }

                var data = {
                    name: legend,
                    color: colors,
                    cat: key,
                    series: series
                }
                //CHART
                var domchart = document.getElementById(chartId);
                var theme = 'default';
                var theChart = echarts.init(domchart,theme);
                var loadingTicket;
                var effectIndex = -1;
                var effect = ['spin'];
                theChart.showLoading({
                    text : '',
                });

                if(data.color[0] !== undefined){
                    dataColor = data.color;
                } else {
                    dataColor = '';
                }
                var option = {
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {
                            type : 'shadow'
                        }
                    },
                    color: dataColor,
                    legend: {
                        data: data.name,
                        x: 'left',
                        y: 'bottom',
                    },
                    grid: {
                        x: '30px',
                        x2: '10px',
                        y: '10px',
                        y2: '60px'
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
                            magicType: {
                                show: true,
                                type: ['stack', 'tiled'],
                                title: {stack: 'Stack', tiled: 'Bar'},
                            },
                            restore: {show: true, title: 'Reload'},
                            saveAsImage: {show: true, title: 'Save'}
                        }
                    },
                    calculable : true,
                    xAxis : [
                        {
                            type : 'category',
                            data : data.cat,
                            axisLabel: {
                                textStyle: {
                                    fontSize: 10
                                }
                            }
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value',
                            axisLabel: {
                                textStyle: {
                                    fontSize: 10
                                },
                                formatter: function (v) {
                                    val = numeral(v).format('0a');
                                    return val;
                                }
                            },
                        }
                    ],
                    series : data.series
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
            }
        }
    });
}
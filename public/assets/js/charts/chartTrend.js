function chartTrend(domId,url,name) {
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
                $('#'+chartId).html('<div class="uk-position-center">No Data!</div>');
            } else {
                var serie=[], key=[], color=[], dmy=[], dates=[];
                for (var i = 0; i < chartData.length; i++) {
                    key[i] = chartData[i].key;
                    color[i] = chartData[i].color;
                    data = chartData[i].value;
                    date = chartData[i].date;
                    for (var n = 0; n < date.length; n++) {
                        dmy[n] = moment.parseZone(date[n]).local().format('DD/MM/YY');
                        if(dmy[0]===dmy[1]){
                            dates[n] = moment.parseZone(date[n]).local().format('HH:mm');
                        } else {
                            dates[n] = moment.parseZone(date[n]).local().format('DD/MM');
                        }
                    }

                    serie[i] = {
                        name: chartData[i].key,
                        type: 'line',
                        data: data
                    }
                }

                var data = {
                    legend: key,
                    colors: color,
                    xaxis: dates,
                    series: serie
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

                if(data.colors[0] !== undefined){
                    dataColor = data.colors;
                } else {
                    dataColor = '';
                }
                var option = {
                    tooltip: {
                        trigger: 'axis',
                        axisPointer : {
                            type : 'shadow'
                        }
                    },
                    color: dataColor,
                    legend: {
                        data: data.legend,
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
                                type: ['line', 'bar'],
                                title: {stack: 'Line', tiled: 'Bar'},
                            },
                            restore: {show: true, title: 'Reload'},
                            saveAsImage: {show: true, title: 'Save'}
                        }
                    },
                    xAxis : [
                        {
                            data : data.xaxis,
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
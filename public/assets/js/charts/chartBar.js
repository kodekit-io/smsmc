function chartBar(domId, url, chartApiData, name) {
    $.ajax({
        method: "POST",
        url: url,
        data: chartApiData,
        beforeSend : function(xhr) {
            $('#'+domId).append(cardloader);
        },
        complete : function(xhr, status) {
            $('#'+domId+' .cardloader').remove();
        },
        success: function(result){
            // console.log(result);
            var result = jQuery.parseJSON(result);
            if (result.length === 0) {
                $('#'+domId).html(cardEmpty);
            } else {
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

                if (chartData.length > 0) {
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
                            formatter: '{b}<br>{a} : {c}',
                            trigger: 'axis',
                            axisPointer : {
                                type : 'shadow'
                            }
                        },
                        legend: {
                            show: true,
                            // data: [chartName],
                            data: [{
                                name: chartName,
                                // icon: 'none'
                            }],
                            x: 'left',
                            y: 'bottom',
                            itemGap: 5,
                            formatter: function (value) {
                                return value;
                            },
                            textStyle: {
                                fontSize: 11
                            },
                            tooltip:{
                                show:true
                            }
                        },
                        grid: {
                            x: '40',
                            x2: '25',
                            y: '10',
                            y2: '60'
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
                                    },
                                    formatter: function (value, index) {
                                        var k = String(key);
                                        var arr = k.split(',');
                                        if (arr.length > 5) {
                                            if(value.length>15){
                                                var shortKey = value.substring(0, 15)+'..';
                                            } else {
                                                var shortKey = value;
                                            }
                                        } else {
                                            var shortKey = value;
                                        }
                                        return shortKey;
                                    }
                                },
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value',
                                axisLabel: {
                                    margin: 5,
                                    inside: false,
                                    showMinLabel: false,
                                    textStyle: {
                                        fontSize: 10
                                    },
                                    formatter: function (v) {
                                        if(v>10) {
                                            val = numeral(v).format('0a');
                                            return val;
                                        } else {
                                            return v;
                                        }
                                    }
                                },
                                axisLine: {
                                    show: false
                                },
                                splitLine: {
                                    show: true,
                                    lineStyle: {
                                        color: ['#000'],
                                        type: 'dotted',
                                        opacity: 0.1
                                    }
                                }
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
                                        color: '#999'
                                    }
                                },
                                label: {
                                    normal: {
                                        position: 'middle',
                                        formatter: '{b} : {c}'
                                    }
                                },
                                data: [
                                    {
                                        name: 'Avg.',
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
                } else {
                    $('#'+chartId).html(msgEmpty);
                }
            }
        },
        error: function(xhr, status){
            $('#'+domId).html(cardEmpty);
        }
    });
}

function chartBarStack(domId, url, chartApiData, name) {
    $.ajax({
        method: "POST",
        url: url,
        data: chartApiData,
        beforeSend : function(xhr) {
            $('#'+domId).append(cardloader);
        },
        complete : function(xhr, status) {
            $('#'+domId+' .cardloader').remove();
        },
        success: function(result){
            // console.log(result);
            var result = jQuery.parseJSON(result);
            // console.log(result);
            if (result.length === 0) {
                $('#'+domId).html(cardEmpty);
            } else {
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

                if (chartData.length > 0) {
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
                            stack: true,
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

                    if (data.series[0].data.length === 0) {
                        $('#'+chartId).html(msgEmpty);
                    } else {
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

                        if (data.color[0]===undefined || data.color[0]=='' || data.color[0]==null) {
                            dataColor = [
                                '#5ab1ef','#ffb980','#07a2a4','#9a7fd1','#588dd5',
                                '#f5994e','#c05050','#7eb00a','#6f5553','#c14089',
                                '#59678c','#c9ab00','#dc69aa','#2ec7c9','#b6a2de',
                            ];
                        } else {
                            dataColor = colors;
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
                                itemGap: 10,
                                itemWidth: 10,
                                itemHeight: 10,
                                textStyle: {
                                    fontSize: 11
                                },
                            },
                            grid: {
                                x: '40',
                                x2: '25',
                                y: '10',
                                y2: '60'
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
                                    data: key,
                                    axisLabel: {
                                        textStyle: {
                                            fontSize: 10
                                        },
                                        formatter: function (value, index) {
                                            var k = String(key);
                                            var arr = k.split(',');
                                            if (arr.length > 5) {
                                                if(value.length>15){
                                                    var shortKey = value.substring(0, 15)+'..';
                                                } else {
                                                    var shortKey = value;
                                                }
                                            } else {
                                                var shortKey = value;
                                            }
                                            return shortKey;
                                        }
                                    },
                                }
                            ],
                            yAxis : [
                                {
                                    type : 'value',
                                    axisLabel: {
                                        margin: 5,
                                        inside: false,
                                        showMinLabel: false,
                                        textStyle: {
                                            fontSize: 10
                                        },
                                        formatter: function (v) {
                                            if(v>10) {
                                                val = numeral(v).format('0a');
                                                return val;
                                            } else {
                                                return v;
                                            }
                                        }
                                    },
                                    axisLine: {
                                        show: false
                                    },
                                    splitLine: {
                                        show: true,
                                        lineStyle: {
                                            color: ['#000'],
                                            type: 'dotted',
                                            opacity: 0.1
                                        }
                                    }
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
                } else {
                    if (chartId==308) {
                        var msg308 = '<div class="uk-position-center uk-text-center">'
                            + '<i class="fa fa-smile-o fa-lg" aria-hidden="true"></i><br>'
                            + 'Nothing to display here,<br>there\'s no Topic in your project'
                        + '</div>';
                        $('#'+chartId).html(msg308);
                    } else {
                        $('#'+chartId).html(msgEmpty);
                    }
                }
            }
        },
        error: function(xhr, status){
            $('#'+domId).html(cardEmpty);
        }
    });
}

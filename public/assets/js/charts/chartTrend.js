function chartTrend(domId, url, chartApiData, title) {
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
            var result = jQuery.parseJSON(result);
            // console.log(result);
            if (result==undefined || result=='') {
                $('#'+domId).replaceWith(cardEmpty);
                // alert('hey');
            }
            var chartId = result.chartId;
            var chartName = result.chartName;
            var chartInfo = result.chartInfo;
            var chartData = result.chartData;
            if (title != null) {
                var chartTitle = title;
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

            if (chartData.length !== undefined || chartData.length  > 0) {
                var serie=[], key=[], color=[], dmy=[], dates=[], dateTZ=[];
                for (var i = 0; i < chartData.length; i++) {
                    key[i] = {name:chartData[i].key,icon:'circle'};
                    color[i] = chartData[i].color;
                    data = chartData[i].value;
                    date = chartData[i].date;

                    for (var n = 0; n < date.length; n++) {
                        var sDate = moment(chartApiData.startDate);
                        var eDate = moment(chartApiData.endDate);
                        // console.log(sDate +' - '+ eDate);
                        var dif = eDate.diff(sDate, 'hours');

                        if(dif<24){
                            dates[n] = moment.parseZone(date[n]).local().format('HH');
                        } else {
                            dateTZ[n] = date[n]+'T23:59:59Z';
                            dates[n] = moment.parseZone(dateTZ[n]).local().format('DD/MM');
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

                if(data.colors[0] === undefined || data.colors[0] == '' || data.colors[0] == null){
                    dataColor = [
                        '#5ab1ef','#ffb980','#07a2a4','#9a7fd1','#588dd5',
                        '#f5994e','#c05050','#7eb00a','#6f5553','#c14089',
                        '#59678c','#c9ab00','#dc69aa','#2ec7c9','#b6a2de',
                    ];
                } else {
                    dataColor = data.colors;
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
                        itemGap: 10,
                        itemWidth: 10,
                        itemHeight: 10,
                        formatter: function (name) {
                            var shortKey = name.substring(0, 10);
                            if(name.length>10){
                                return shortKey+'..';
                            } else {
                                return name;
                            }
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
            } else {
                $('#'+chartId).html(msgEmpty);
            }
        },
        error: function(xhr, status){
            $('#'+domId).html(cardEmpty);
        }
    });
}

function chartTrendCombo(domId, url, chartApiData, title) {
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
            if (result[0]===undefined) {
                $('#'+domId).html(cardEmpty);
            }
            var result = jQuery.parseJSON(result);
            var chartId = result.chartId;
            var chartName = result.chartName;
            var chartInfo = result.chartInfo;
            var chartData = result.chartData;
            if (title != null) {
                var chartTitle = title;
            } else {
                var chartTitle = chartName;
            }

            var $item = [], $nav=[];
            if (chartData.length > 0) {
                for(var x = 0; x < chartData.length; x++) {
                    var key = result.chartData[x].name;
                    if(key.length>10){
                        var shortKey = key.substring(0, 10)+'..';
                    } else {
                        var shortKey = key;
                    }

                    $nav[x] = '<li><a class="uk-text-capitalize" title="'+key+'" uk-tooltip>'+shortKey+'</a></li>';
                    $item[x] = '<li id="chart'+[x]+'" class="sm-chart"></li>';
                }
            }
            var card = '<div id="'+chartId+'" class="sm-chart-container uk-animation-fade">'
                + '<div class="uk-card uk-card-hover uk-card-default uk-card-small">'
                    + '<div class="uk-card-header uk-clearfix">'
                        + '<h5 class="uk-card-title uk-float-left">'+chartTitle+'</h5>'
                        + '<ul class="uk-float-right uk-subnav uk-margin-remove">'
                            + '<li><a class="grey-text fa fa-info-circle" title="'+chartInfo+'" uk-tooltip></a></li>'
                            + '<li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>'
                            + '<li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>'
                        + '</ul>'
                    + '</div>'
                    + '<div class="uk-card-body sm-trend-combo">'
                        + '<ul class="uk-subnav uk-subnav-divider sm-key-switch uk-margin-right uk-margin-remove-bottom" uk-switcher>'
                            + $nav.join('')
                        + '</ul>'
                        + '<ul class="uk-switcher">'
                            + $item.join('')
                        + '</ul>'
                    + '</div>'
                + '</div>'
            + '</div>';
            $('#'+domId).append(card);

            if (chartData.length > 0) {
                var data = [];
                for (var x = 0; x < chartData.length; x++) {
                    name = chartData[x].name;
                    data[x] = chartData[x].data;
                    id = [x];
                    itemCombo(id,url,chartApiData,result);
                }
            } else {
                $('.sm-trend-combo').html('<div class="sm-chart">'+ msgEmpty +'</div>');
            }

        },
        error: function(xhr, status){
            $('#'+domId).html(cardEmpty);
        }
    });
}
function itemCombo(id, url, chartApiData, result) {
    var chartData = result.chartData[id].data;
    if (chartData.length > 0) {
        var serie=[], key=[], color=[], dmy=[], dates=[], dateTZ=[];
        for (var i = 0; i < chartData.length; i++) {
            key[i] = {name:chartData[i].key,icon:'circle'};
            color[i] = chartData[i].color;
            data = chartData[i].value;
            date = chartData[i].date;

            for (var n = 0; n < date.length; n++) {
                var sDate = moment(chartApiData.startDate);
                var eDate = moment(chartApiData.endDate);
                // console.log(sDate +' - '+ eDate);
                var dif = eDate.diff(sDate, 'hours');

                if(dif<24){
                    dates[n] = moment.parseZone(date[n]).local().format('HH');
                } else {
                    dateTZ[n] = date[n]+'T23:59:59Z';
                    dates[n] = moment.parseZone(dateTZ[n]).local().format('DD/MM');
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
        //$('#chart'+id).append('hehe'+id);
        //CHART
        var domchart = document.getElementById('chart'+id);
        var theme = 'default';
        var theChart = echarts.init(domchart,theme);
        var loadingTicket;
        var effectIndex = -1;
        var effect = ['spin'];
        theChart.showLoading({
            text : '',
        });

        if(data.colors[0] === undefined || data.colors[0] == '' || data.colors[0] == null){
            dataColor = [
                '#5ab1ef','#ffb980','#07a2a4','#9a7fd1','#588dd5',
                '#f5994e','#c05050','#7eb00a','#6f5553','#c14089',
                '#59678c','#c9ab00','#dc69aa','#2ec7c9','#b6a2de',
            ];
        } else {
            dataColor = data.colors;
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
                itemGap: 10,
                itemWidth: 10,
                itemHeight: 10,
                formatter: function (name) {
                    var shortKey = name.substring(0, 10);
                    if(name.length>10){
                        return shortKey+'..';
                    } else {
                        return name;
                    }
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
                y: '40',
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
            $('.uk-switcher').on('show.uk.switcher', function(){
                theChart.resize();
            });
        },1200);
        $(window).on('resize', function(){
            if(theChart != null && theChart != undefined){
                theChart.resize();
            }
        });
    } else {
        $('.uk-card-body').html(msgEmpty);
    }
}

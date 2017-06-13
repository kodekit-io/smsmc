function chartBar(domId, url, chartApiData, name) {
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

                var card = '<div class="sm-chart-container">'
                    + '<div class="uk-card uk-card-small">'
                        + '<div class="">'
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
                        title: {
                            text: chartName.toUpperCase(),
                            left: '10px',
                            top: '10px',
                        },
                        backgroundColor: '#ffffff',
                        animation: false,
                        legend: {
                            show: true,
                            data: [{
                                name: chartName,
                                icon: 'circle'
                            }],
                            left: '10px',
                            bottom: '10px',
                            itemGap: 5,
                            textStyle: {
                                fontSize: 11,
                                color: '#333'
                            }
                        },
                        grid: {
                            x: '15px',
                            x2: '15px',
                            y: '50px',
                            y2: '75px'
                        },
                        toolbox: {
                            show: false,
                        },
                        xAxis : [
                            {
                                type : 'category',
                                data: key,
                                axisLabel: {
                                    textStyle: {
                                        fontSize: 11
                                    },
                                    formatter: function (value, index) {
                                        var k = String(key);
                                        var arr = k.split(',');
                                        if (arr.length > 3) {
                                            if(value.length>3){
                                                var shortKey = value.substring(0, 3)+'..';
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
                                splitLine: {
                                    show: true
                                },
                                axisLine: {
                                    show: false
                                },
                                axisLabel: {
                                    show: false
                                },
                            }
                        ],
                        series : {
                            name: chartName,
                            type: 'bar',
                            barMaxWidth: '50%',
                            markLine : {
                                lineStyle: {
                                    normal: {
                                        color: '#666'
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
                                        name: 'Average',
                                        type: 'average'
                                    }
                                ]
                            },
                            label: {
                                normal: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontSize: 11
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
                        imgUrl = theChart.getDataURL();
                        if($("#report-form").length !== 0) {
                            //console.log('add');
                            $('#report-form').append('<input type="hidden" name="'+domId+'" value="'+imgUrl+'" />');
                        }
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
            $('.cardloader').remove();
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

                var card = '<div class="sm-chart-container">'
                    + '<div class="uk-card uk-card-small">'
                        + '<div class="">'
                            + '<div id="'+chartId+'" class="sm-chart"></div>'
                        + '</div>'
                    + '</div>'
                + '</div>';
                $('#'+domId).append(card);

                if (chartData.length > 0) {
                    var series=[], legend=[], colors=[], key=[], name=[];
                    for (var i = 0; i < chartData.length; i++) {
                        name[i] = chartData[i].name;
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
                            label: {
                                normal: {
                                    show: true,
                                    position: 'right',
                                    textStyle: {
                                        fontSize: 11
                                    }
                                }
                            },
                            data: data
                        }
                        legend[i] = {
                            name: chartData[i].name,
                            icon: 'circle'
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
                            title: {
                                text: chartName.toUpperCase(),
                                left: '10px',
                                top: '10px',
                            },
                            backgroundColor: '#ffffff',
                            animation: false,
                            color: dataColor,
                            legend: {
                                show: true,
                                data: data.name,
                                left: '10px',
                                bottom: '10px',
                                itemGap: 5,
                                textStyle: {
                                    fontSize: 11,
                                    color: '#333'
                                }
                            },
                            grid: {
                                x: '15px',
                                x2: '15px',
                                y: '50px',
                                y2: '75px'
                            },
                            toolbox: {
                                show: false,
                            },
                            xAxis : [
                                {
                                    type : 'category',
                                    data: key,
                                    axisLabel: {
                                        textStyle: {
                                            fontSize: 11
                                        },
                                        formatter: function (value, index) {
                                            var k = String(key);
                                            var arr = k.split(',');
                                            if (arr.length > 3) {
                                                if(value.length>3){
                                                    var shortKey = value.substring(0, 3)+'..';
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
                                    splitLine: {
                                        show: true
                                    },
                                    axisLine: {
                                        show: false
                                    },
                                    axisLabel: {
                                        show: false
                                    },
                                }
                            ],
                            series : data.series
                        };

                        clearTimeout(loadingTicket);
                        loadingTicket = setTimeout(function (){
                            theChart.hideLoading();
                            theChart.setOption(option);
                            imgUrl = theChart.getDataURL();
                            if($("#report-form").length !== 0) {
                                //console.log('add');
                                $('#report-form').append('<input type="hidden" name="'+domId+'" value="'+imgUrl+'" />');
                            }
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

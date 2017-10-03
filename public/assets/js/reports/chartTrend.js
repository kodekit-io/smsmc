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

            var card = '<div class="sm-chart-container ">'
                + '<div class="uk-card uk-card-small">'
                    + '<div class="">'
                        + '<div id="'+chartId+'" class="sm-chart"></div>'
                    + '</div>'
                + '</div>'
            + '</div>';
            $('#'+domId).append(card);

            if (chartData.length !== undefined || chartData.length  > 0) {
                var serie=[], key=[], color=[], dmy=[], dates=[], legend=[];
                for (var i = 0; i < chartData.length; i++) {
                    key[i] = chartData[i].key;
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
                            dates[n] = moment.parseZone(date[n]).local().format('DD/MM');
                        }
                    }

                    serie[i] = {
                        name: chartData[i].key,
                        type: 'line',
                        data: data,
                        smooth: false,
                        label: {
                            normal: {
                                show: true,
                                position: 'top',
                                textStyle: {
                                    fontSize: 11
                                }
                            }
                        },
                    }
                    legend[i] = {
                        name: chartData[i].key,
                        icon: 'circle'
                    }
                }

                var data = {
                    legend: legend,
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
                    title: {
                        text: chartName.toUpperCase(),
                        left: '10px',
                        top: '10px',
                    },
                    backgroundColor: '#ffffff',
                    animation: false,
                    color: dataColor,
                    legend: {
                        data: data.legend,
                        left: '10px',
                        bottom: '10px',
                        itemGap: 5,
                        formatter: function (name) {
                            var shortKey = name.substring(0, 10);
                            if(name.length>10){
                                return shortKey+'..';
                            } else {
                                return name;
                            }
                        },
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
                            data : data.xaxis,
                            axisLabel: {
                                textStyle: {
                                    fontSize: 11
                                }
                            }
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
            } else {
                $('#'+chartId).html(msgEmpty);
            }
        },
        error: function(xhr, status){
            $('#'+domId).html(cardEmpty);
        }
    });
}

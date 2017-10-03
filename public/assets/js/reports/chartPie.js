function chartPie(domId, url, chartApiData, name) {
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
                var serie=[], key=[], color=[], value=[], legend=[];
                for (var i = 0; i < chartData.length; i++) {
                    key[i] = chartData[i].key;
                    color[i] = chartData[i].color;
                    value[i] = chartData[i].value;
                    serie[i] = {value: value[i], name: key[i]};

                    legend[i] = {
                        name: chartData[i].key,
                        icon: 'circle'
                    }
                }

                //CHART
                var domchart = document.getElementById(chartId);
                var theme = 'default';
                var theChart = echarts.init(domchart,theme);
                var loadingTicket;
                //var effectIndex = -1;
                //var effect = ['spin'];

                theChart.showLoading({
                    text : '',
                });

                if(color[0] == '' || color[0] === undefined || color[0] == null){
                    dataColor = [
                        '#5ab1ef','#ffb980','#07a2a4','#9a7fd1','#588dd5',
                        '#f5994e','#c05050','#7eb00a','#6f5553','#c14089',
                        '#59678c','#c9ab00','#dc69aa','#2ec7c9','#b6a2de',
                    ];
                } else {
                    dataColor = chartData.colors;
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
                        orient: 'vertical',
                        data: legend,
                        left: '10px',
                        bottom: '10px',
                        itemGap: 5,
                        itemWidth: 15,
                        itemHeight: 12,
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
                    series: [
                        {
                            name: chartName,
                            type:'pie',
                            radius: ['25%', '50%'],
                            center: ['50%', '50%'],
                            avoidLabelOverlap: true,
                            label: {
                                normal: {
                                    formatter: '{d}%',
                                    show: true,
                                }
                            },
                            labelLine: {
                                normal: {
                                    show: true
                                }
                            },
                            data: serie
                        }
                    ]
                };

                clearTimeout(loadingTicket);
                loadingTicket = setTimeout(function (){
                    theChart.hideLoading();
                    theChart.setOption(option);
                    theChart.resize();
                    imgUrl = theChart.getDataURL();
                    if($("#report-form").length !== 0) {
                        //console.log('add');
                        // $('#report-form').append('<img src="'+imgUrl+'" />');
                        $('#report-form').append('<input type="hidden" name="'+domId+'" value="'+imgUrl+'" />');
                    }
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

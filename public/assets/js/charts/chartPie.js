function chartPie(domId, url, chartApiData, name) {
    var xxx=0;
    $.ajax({
        method: "POST",
        url: url,
        data: chartApiData,
        beforeSend : function(xhr) {
            var cardloader = '<div class="cardloader sm-chart-container uk-animation-fade">'
                + '<div class="uk-card uk-card-small">'
                    + '<div class="uk-card-header uk-clearfix">'
                        + '<h5 class="uk-card-title uk-float-left"></h5>'
                    + '</div>'
                    + '<div class="uk-card-body">'
                        + '<div class="sm-chart"><div class="uk-position-center" uk-spinner></div></div>'
                    + '</div>'
                + '</div>'
            + '</div>';
            $('#'+domId).append(cardloader);
            xxx++;
        },
        complete : function(xhr, status) {
            xxx--;
            if (xxx <= 0) {
                $('.cardloader').remove();
            }
        },
        success: function(result){
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
                var serie=[], key=[], color=[], value=[];
                for (var i = 0; i < chartData.length; i++) {
                    key[i] = chartData[i].key;
                    color[i] = chartData[i].color;
                    value[i] = chartData[i].value;
                    serie[i] = {value: value[i], name: key[i]};
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

                if(color[0] !== '' && color.length > 0){
                    dataColor = data.colors;
                } else {
                    dataColor = [
                        '#5ab1ef','#ffb980','#07a2a4','#9a7fd1','#588dd5',
                        '#f5994e','#c05050','#7eb00a','#6f5553','#c14089',
                        '#59678c','#c9ab00','#dc69aa','#2ec7c9','#b6a2de',
                    ];
                }

                var option = {
                    tooltip: {
                        trigger: 'item',
                        formatter: "{a}<br/>{b}: {c} ({d}%)"
                    },
                    color: dataColor,
                    grid: {
                        x: '0',
                        x2: '0',
                        y: '0',
                        y2: '0'
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
                    legend: {
                        orient: 'vertical',
                        x: 'left',
                        y: 'bottom',
                        data: key
                    },
                    series: [
                        {
                            name: chartName,
                            type:'pie',
                            radius: ['25%', '75%'],
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
function barSample(div,domId,judul) {
    $.ajax({
        url: 'json/trend-sample.json',
        //dataType: 'jsonp',
        success: function(result){
            var chartId = result.chartId;
            var chartName = result.chartName;
            var data = result.data;

            if (data.length === 0) {
                $('#'+chartId).html("<div class='center'>No Data</div>");
            } else {
                var series=[], names=[], colors=[];
                for (var i = 0; i < data.length; i++) {
                    name = data[i].name;
                    names[i] = data[i].name;
                    colors[i] = data[i].color;
                    xaxis = data[i].xaxis;
                    yaxis = data[i].yaxis;

                    //console.log(yaxis);

                    series[i] = {
                        type: 'line',
                        name: name,
                        data: yaxis
                    }
                }
                var dataseries = {
                    color: colors,
                    category: xaxis,
                    legend: names,
                    series: series
                }

                var card = '<div id="'+domId+'" class="sm-chart-container uk-animation-fade"> \
                    <div class="uk-card uk-card-hover uk-card-default uk-card-small"> \
                        <div class="uk-card-header uk-clearfix"> \
                            <h5 class="uk-card-title uk-float-left">'+judul+'</h5> \
                            <ul class="uk-float-right uk-subnav uk-margin-remove"> \
                                <li><a class="grey-text fa fa-info-circle" title="Short text information about '+judul+'" uk-tooltip></a></li> \
                                <li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li> \
                                <li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li> \
                            </ul> \
                        </div> \
                        <div class="uk-card-body"> \
                            <div id="'+domId+'Chart" class="sm-chart"></div> \
                        </div> \
                    </div> \
                </div>';
                $('#'+div).append(card);

                //CHART
                var dom = document.getElementById(domId+'Chart');
                var theme = 'default';
                var theChart = echarts.init(dom,theme);
                var loadingTicket;
                var effectIndex = -1;
                var effect = ['spin'];
                //var effectIndex = ++effectIndex % effect.length;
                theChart.showLoading({
                    text : '',
                    //effect : effect[effectIndex],
                });

                var option = {
                    //color: ['#3398DB'],
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {
                            type : 'shadow'
                        }
                    },
                    grid: {
                        x: '20px',
                        x2: '10px',
                        y: '10px',
                        y2: '20px',
                        containLabel: true
                    },
                    toolbox: {
                        show: true,
                        x: 'right',
                        y: 'bottom',
                        padding: ['0', '0', '0', '0'],
                        feature: {
                            mark: {show: true},
                            restore: {show: true, title: 'Reload'},
                            saveAsImage: {show: true, title: 'Save'}
                        }
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : ['A', 'B', 'C', 'D', 'D']
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            name:judul,
                            type:'bar',
                            barWidth: '40%',
                            data:[200, 334, 390, 330, 220]
                        }
                    ]
                };

                clearTimeout(loadingTicket);
                loadingTicket = setTimeout(function (){
                    theChart.hideLoading();
                    theChart.setOption(option);
                    theChart.resize();
                },1800);
                $(window).on('resize', function(){
                    if(theChart != null && theChart != undefined){
                        theChart.resize();
                    }
                });
            }
        }
    });

}
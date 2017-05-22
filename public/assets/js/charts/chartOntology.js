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
            var result = jQuery.parseJSON(result);
            // console.log(result);
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

                var serie=[];
                for (var i = 0; i < data.length; i++) {
					// if (i < 25) {
						serie[i] = {
	                        name: data[i].name,
	                        value: data[i].value,
	                        // symbolSize: data[i].value,
	                        category: data[i].category,
	                        node: data[i].node
	                    }
					// }
                }
                // console.log(serie);
                var option = {
                    legend: {
                        data: result.categories,
                        itemWidth: 15,
                        x: 'left',
                        y: 'bottom',
                        formatter: function (name) {
                            var shortKey = name.substring(0, 10);
                            if(name.length>10){
                                return shortKey+'..';
                            } else {
                                return name;
                            }
                        },
                        tooltip:{
                            show:true
                        }
                    },
                    grid: {
                        // show: true,
                        x: '0',
                        x2: '0',
                        y: '0',
                        y2: '60',
                    },
                    tooltip: {
                        trigger: 'item',
                        //formatter: '{c}'
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
                        roam: false,
                        animation: false,
                        label: {
                            normal: {
                                show: true,
                                position: 'right',
                                formatter: '{b}'
                            }
                        },
                        draggable: true,
                        data: result.nodes.map(function (node, idx) {
                            node.id = idx;
                            return node;
                        }),
						// data: serie,
                        categories: result.categories,
                        force: {
                            repulsion: 50,
                            gravity: 0.25,
                            edgeLength: 30,
                            layoutAnimation: true,
                        },
                        edges: result.links,
                        itemStyle: {},
                        lineStyle: {
                            normal: {
                                color: 'source',
                                curveness: 0.1
                            }
                        }
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

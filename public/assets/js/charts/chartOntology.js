function chartOntology(domId,url,name) {
    $.get(url, function (result) {
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

        //theChart.hideLoading();

        var option = {
            legend: {
                data: result.categories,
                x: 'left',
                y: 'bottom',
            },
            grid: {
                x: 0,
                x2: 0,
                y: 0,
                y2: 0
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
                roam: true,
                animation: true,
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
                categories: result.categories,
                force: {
                    //initLayout: 'circular',
                    edgeLength: 50,
                    repulsion: 100,
                    gravity: 0.2
                },
                edges: result.links,
                itemStyle: {},
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
    });

}
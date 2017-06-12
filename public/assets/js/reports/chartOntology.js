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

            var card = '<div class="sm-chart-container uk-animation-fade uk-position-relative" id="chartOntology">'
                + '<div class="uk-card uk-card-hover uk-card-default uk-card-small">'
                    + '<div class="uk-card-header uk-clearfix">'
                        + '<h5 class="uk-card-title uk-float-left">'+chartTitle+'</h5>'
                    + '</div>'
                    + '<div class="uk-card-body">'
                        + '<div id="'+chartId+'" class="sm-chart"></div>'
                    + '</div>'
                + '</div>'
            + '</div>';
            $('#'+domId).append(card);
            var typeSelector = '<select class="uk-select uk-form-small uk-position-top-right" id="selectType" style="margin:10px 125px 0 0;width:auto;"><option value="force" selected>Force</option><option value="circular">Circular</option></select>';
            $('#chartOntology').append(typeSelector);

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

                var graph = result;
                var categories = graph.categories;
                // console.log(graph);

                var optionColor = categories.map(function (c) {
                    // console.log(c.color);
                    if(c.color == '' || c.color == 'undefined' || c.color == undefined || c.color == null){
                        return '#c05050';
                    } else {
                        return c.color;
                    }
                });
                var optionLegend = {
                    data: categories.map(function (a) {
                        return a.name;
                    }),
                    itemWidth: 15,
                    x: 'left',
                    y: 'bottom',
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
                        fontSize: 11
                    },
                    tooltip:{
                        show:true
                    }
                };

                // console.log(graph.nodes);
                var optionData = graph.nodes.map(function (node) {
                    return {
                        id: node.name,
                        name: node.name,
                        symbolSize: node.value,
                        value: node.value,
                        category: node.category,
                    };
                });
                var optionLinks = graph.links.map(function (link) {
                    return {
                        source: link.source,
                        target: link.target,
                        lineStyle: {
                            normal: {
                                color: link.color,
                                curveness: 0.3,
                                width: 2
                            }
                        }
                    };
                });
                var optionLabel = {
                    normal: {
                        show: true,
                        position: 'right',
                        formatter: '{b}'
                    }
                };

                var option = {
                    // tooltip: {},
                    color: optionColor,
                    legend: optionLegend,
                    // animationDuration: 1500,
                    // animationEasingUpdate: 'quinticInOut',
                    series : [
                        {
                            name: graph.chartName,
                            type: 'graph',
                            layout: 'force',
                            force: {
                                repulsion: 100,
                                gravity: 0.1,
                                edgeLength: 50,
                                layoutAnimation: true,
                            },
                            data: optionData,
                            links: optionLinks,
                            categories: categories,
                            roam: true,
                            // focusNodeAdjacency: true,
                            draggable: true,
                            label: optionLabel
                        }
                    ]
                };
                var optionCircular = {
                    // tooltip: {},
                    color: optionColor,
                    legend: optionLegend,
                    // animationDuration: 1500,
                    // animationEasingUpdate: 'quinticInOut',
                    series : [
                        {
                            name: graph.chartName,
                            type: 'graph',
                            layout: 'circular',
                            data: optionData,
                            links: optionLinks,
                            categories: categories,
                            roam: true,
                            // focusNodeAdjacency: true,
                            draggable: true,
                            label: optionLabel
                        }
                    ]
                };
                clearTimeout(loadingTicket);
                loadingTicket = setTimeout(function (){
                    theChart.hideLoading();
                    theChart.setOption(option);
                    imgUrl = theChart.getDataURL();
                    if($("#report-form").length !== 0) {
                        console.log('add');
                        $('#report-form').append('<input type="hidden" name="'+domId+'" value="'+imgUrl+'" />');
                    }
                    theChart.resize();
                },1200);
                $(window).on('resize', function(){
                    if(theChart != null && theChart != undefined){
                        theChart.resize();
                    }
                });

                $('#selectType').on('change', function() {
                    var typeselected = $(this).find(":selected").val();
                    if (typeselected == 'circular') {
                        theChart.setOption(optionCircular);
                    } else {
                        theChart.setOption(option);
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

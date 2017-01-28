projectList('projectList','list');

function projectList(div,type) {
    $.ajax({
        url: 'json/project-list.json',
        //dataType: 'jsonp',
        success: function(result){
            var data = result.projectList;
            //console.log(data);

            if (data.length === 0) {
                $('#'+div).html("<div class='uk-text-center'>No Data</div>");
            } else {
                for (var i = 0; i < data.length; i++) {
                    pid = data[i].pid;
                    pdate = data[i].pdate;
                    pgroup = data[i].pgroup;
                    pname = data[i].pname;
                    length = data.length;

                    if (type === 'grid') {
                        var project = '<div id="'+pid+'"> \
                            <div class="uk-card uk-card-hover uk-card-default uk-card-small"> \
                                <div class="uk-card-header"> \
                                    <h5 class="uk-card-title">'+pname+'</h5> \
                                </div> \
                                <div class="uk-card-body"> \
                                    <div uk-grid class="uk-grid-collapse"> \
                                        <div class="uk-width-1-1"> \
                                            <div id="coverChart_'+pid+'" class="sm-chartcover">Cover Chart</div> \
                                        </div> \
                                        <div class="uk-width-2-5">Date Create</div> \
                                        <div class="uk-width-3-5">: '+pdate+'</div> \
                                        <div class="uk-width-2-5">Project Group</div> \
                                        <div class="uk-width-3-5">: '+pgroup+'</div> \
                                    </div> \
                                </div> \
                                <div class="uk-card-footer uk-clearfix"> \
                                    <div class="uk-inline"> \
                                        <a class="grey-text" uk-icon="icon: more-vertical"></a> \
                                        <div class="sm-card-action" uk-drop="mode: click; pos: right-center"> \
                                            <a uk-toggle="target: #edit_'+pid+'" class="uk-icon-button green white-text" uk-icon="icon: pencil" title="Edit Project" uk-tooltip></a> \
                                            <a uk-toggle="target: #delete_'+pid+'" class="uk-icon-button red white-text" uk-icon="icon: trash" title="Delete Project" uk-tooltip></a> \
                                        </div> \
                                    </div> \
                                    <a href="./project-all?pid='+pid+'" class="uk-button uk-button-text uk-float-right red-text">View Project</a> \
                                </div> \
                            </div> \
                        </div> \
                        <div id="edit_'+pid+'" uk-modal> \
                            <div class="uk-modal-dialog"> \
                                <div class="uk-modal-body"><h5>Edit Project <span class="uk-text-uppercase">'+pname+'</span>?</h5></div> \
                                <div class="uk-modal-footer uk-clearfix"> \
                                    <a class="uk-modal-close uk-button grey white-text">CANCEL</a> \
                                    <a href="./edit?pid='+pid+'" class="uk-button uk-float-right blue white-text">YES</a> \
                                </div> \
                            </div> \
                        </div> \
                        <div id="delete_'+pid+'" uk-modal> \
                            <div class="uk-modal-dialog"> \
                                <div class="uk-modal-body"> \
                                    <h5>Are You Sure?</h5> \
                                    <p>Project <span class="uk-text-uppercase">'+pname+'</span> will no longer available.</p> \
                                </div> \
                                <div class="uk-modal-footer uk-clearfix"> \
                                    <a class="uk-modal-close uk-button grey white-text">CANCEL</a> \
                                    <a href="./delete?pid='+pid+'" class="uk-button uk-float-right red white-text">YES</a> \
                                </div> \
                            </div> \
                        </div>';
                        $('#'+div).append(project);
                        //chartCover(pid);

                    } else if (type === 'list') {
                        var project = '<li><a href="./project-all?pid='+pid+'">'+pname+'</a></li>';
                        $('#'+div).append(project);
                    }

                }
            }
        }
    });
}

//function chartCover(pid) {
    //$('#coverChart_'+pid).html(pid);
    // based on prepared DOM, initialize echarts instance
    var myChart = echarts.init(document.getElementById('sini'));

    // specify chart configuration item and data
    var option = {
        title: {
            text: 'ECharts entry example'
        },
        tooltip: {},
        legend: {
            data:['Sales']
        },
        xAxis: {
            data: ["shirt","cardign","chiffon shirt","pants","heels","socks"]
        },
        yAxis: {},
        series: [{
            name: 'Sales',
            type: 'bar',
            data: [5, 20, 36, 10, 10, 20]
        }]
    };

    // use configuration item and data specified to show chart
    myChart.setOption(option);

	$(window).trigger("resize");

//}
$(document).ready(function() {
    $('[data-toggle="datepicker"]').datepicker({
        format: 'dd-mm-yyyy'
    });

    projectList('projectList');
});

function projectList(div) {
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

                    var project = '<li><a href="'+baseUrl+'/project-all?pid='+pid+'">'+pname+'</a></li>';
                    $('#'+div).append(project);

                }
            }
        }
    });
}
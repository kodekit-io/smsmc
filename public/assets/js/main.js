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

function fullscreen(obj) {
    //alert($(obj).attr('class'));
    $(obj).toggleClass('fa-expand').toggleClass('fa-compress');
    $(obj).closest('.sm-chart-container').toggleClass('fullscreen');
    $(window).trigger('resize');
}
function hideThis(obj) {
    //alert($(obj).attr('class'));
    $(obj).closest('.sm-chart-container').parent().toggleClass('uk-hidden');
    $('.btn-unhide').removeClass('uk-hidden');
    $(window).trigger('resize');
}
function unhideAll(obj) {
    //alert($(obj).attr('class'));
    $('.sm-chart-container').parent().removeClass('uk-hidden');
    $(obj).addClass('uk-hidden');
    $(window).trigger('resize');
}
function screenshot() {
    $('section.sm-main').html2canvas({
        letterRendering: true,
        background: '#eeeeee',
        onrendered: function (canvas) {
            var a = document.createElement('a');
            a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
            a.download = 'sinarmas.jpg';
            a.click();
        }
    });
}
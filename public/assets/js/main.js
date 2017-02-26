(function ($, window, document) {
    $(function () {
        $('[data-toggle="datepicker"]').datetimepicker({
            format: 'd-m-y H:i'
        });
        projectList('projectList','json/project-list-all.json');
    });
    function projectList(dom,url) {
        var x = 0;
        $.ajax({
            url: url,
            beforeSend : function(xhr) {
                $('#'+dom).append('<div class="uk-position-center uk-width-auto" uk-spinner></div>');
                x++;
            },
            complete : function(xhr, status) {
                x--;
                if (x <= 0) {
                    $('[uk-spinner]').remove();
                }
            },
            success : function(result) {
                var data = result.projectList;

                if (data.length === 0) {
                    $('#'+dom).append('<div class="uk-position-center uk-text-center">No Data!</div>');
                } else {
                    for (var i = 0; i < data.length; i++) {
                        pid = data[i].pid;
                        pdate = data[i].pdate;
                        pgroup = data[i].pgroup;
                        pname = data[i].pname;
                        length = data.length;

                        var project = '<li><a href="'+baseUrl+'/project-all?pid='+pid+'">'+pname+'</a></li>';
                        $('#'+dom).append(project);

                    }
                }
            },
            error: function (request, status, error) {
                $('#'+dom).append('<div class="uk-position-center uk-text-center">FOUT!</div>');
            }
        });
    }
    function YouTubeGetID(url) {
        var ID = '';
        url = url.replace(/(>|<)/gi, '').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
        if (url[2] !== undefined) {
            ID = url[2].split(/[^0-9a-z_\-]/i);
            ID = ID[0];
        } else {
            ID = url;
        }
        return ID;
    }

}(window.jQuery, window, document));

function fullscreen(obj) {
    $(obj).toggleClass('fa-expand').toggleClass('fa-compress');
    $(obj).closest('.sm-chart-container').toggleClass('fullscreen');
    $(window).trigger('resize');
}
function hideThis(obj) {
    $(obj).closest('.sm-chart-container').parent().toggleClass('uk-hidden');
    $('.btn-unhide').removeClass('uk-hidden');
    $(window).trigger('resize');
}
function unhideAll(obj) {
    $('.sm-chart-container').parent().removeClass('uk-hidden');
    $(obj).addClass('uk-hidden');
    $(window).trigger('resize');
}

//Screenshot
function savePage() {
    $('section.sm-main').html2canvas({
        //letterRendering: true,
        //allowTaint: true,
        background: '#eeeeee',
        onrendered: function (canvas) {
            var url = canvas.toDataURL();
            $("<a>", {
                href: url,
                download: "sinarmas.png"
            })
            .on("click", function() {
                $(this).remove();
            })
            .appendTo("body")[0].click();
        }
    });
}
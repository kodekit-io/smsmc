(function ($, window, document) {
    $(function () {
        setTimeout(function() { $(".sm-alert a.uk-alert-close").click(); }, 10000);

        // $('input.datetimepicker[name=startDate]').datetimepicker({
        //     format:	'd/m/y H:i'
        // });
        // $('input.datetimepicker[name=endDate]').datetimepicker({
        //     format:	'd/m/y H:i'
        // });
        jQuery('input[name=startDate]').datetimepicker({
            format:	'd/m/y H:i',
            onShow:function( ct ){
                this.setOptions({
                    maxDate:jQuery('input[name=endDate]').val()?jQuery('input[name=endDate]').val():false
                })
            },
            // timepicker:false
        });
        jQuery('input[name=endDate]').datetimepicker({
            format:	'd/m/y H:i',
            onShow:function( ct ){
                this.setOptions({
                    // minDate:jQuery('input[name=startDate]').val()?jQuery('input[name=startDate]').val():false,
                    maxDate:'0'
                })
            },
            // timepicker:false
        });
        $('.select-all-keyword').checkAll(
            { container: $('#select-keyword'), showIndeterminate: true }
        );
        $('.select-all-topic').checkAll(
            { container: $('#select-topic'), showIndeterminate: true }
        );
        $('.select-all-account').checkAll(
            { container: $('#select-account'), showIndeterminate: true }
        );
        $('.select-all-channel').checkAll(
            { container: $('#select-channel'), showIndeterminate: true }
        );

        projectList('projectList', baseUrl + '/get-project-list');
    });

    function projectList(dom, url) {
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
                result = jQuery.parseJSON(result);
                var data = result.projectList;

                if (data.length === 0) {
                    $('#'+dom).append('<div class="uk-position-center uk-text-center">You don\'t have any project yet.<br>Please contact your administrator.</div>');
                } else {
                    for (var i = 0; i < data.length; i++) {
                        pid = data[i].pid;
                        pdate = data[i].pdate;
                        pgroup = data[i].pgroup;
                        pname = data[i].pname;
                        length = data.length;

                        var project = '<li><a href="' + baseUrl + '/project/all/'+pid+'">'+pname+'</a></li>';
                        $('#'+dom).append(project);

                    }
                }
            },
            error: function (request, status, error) {
                $('#'+dom).append('<div class="uk-position-center uk-text-center">FOUT!</div>');
            }
        });
    }
}(window.jQuery, window, document));

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

function popup(url,width,height){
    var pop=window.open(url,'Sinar Mas','width='+width+',height='+height+',resizable=0');
    return false;
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

var msgEmpty = '<div class="uk-position-center uk-text-center">'
    + '<i class="fa fa-smile-o fa-lg" aria-hidden="true"></i><br>'
    + 'Sorry, there is no data to display.'
+ '</div>';
var cardEmpty = '<div class="sm-chart-container uk-animation-fade">'
    + '<div class="uk-card uk-card-hover uk-card-default uk-card-small">'
        + '<div class="uk-card-header uk-clearfix">'
            + '<h5 class="uk-card-title uk-float-left">&nbsp;</h5>'
        + '</div>'
        + '<div class="uk-card-body">'
            + '<div class="sm-chart">'+msgEmpty+'</div>'
        + '</div>'
    + '</div>'
+ '</div>';
var cardloader = '<div class="cardloader sm-chart-container uk-animation-fade">'
    + '<div class="uk-card uk-card-small">'
        + '<div class="uk-card-header uk-clearfix">'
            + '<h5 class="uk-card-title uk-float-left">&nbsp;</h5>'
        + '</div>'
        + '<div class="uk-card-body">'
            + '<div class="sm-chart"><div class="uk-position-center" uk-spinner></div></div>'
        + '</div>'
    + '</div>'
+ '</div>';

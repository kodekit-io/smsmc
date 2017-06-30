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
    var pop = window.open(url,'Sinar Mas','width='+width+',height='+height+',resizable=0,toolbar=no,location=no');
    pop.document.body.innerHTML = '<a href="#" onclick="window.opener.location.reload();window.close();">CLOSE THIS WINDOW</a>';
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

function sendTicket(chartId,chartApiData,theTable) {
    $('#' + chartId).on('click', '.sm-btn-openticket', function(e) {
        e.preventDefault();
        $(this).blur();
        var postId = $(this).attr('data-id');
        var postDate = $(this).attr('data-post-date');
        var sentiment = $(this).attr('data-sentiment');
        var idMedia = $(this).attr('data-id-media');
        var $ticketTypes = jQuery.parseJSON(chartApiData.ticketTypes);
        var $users = jQuery.parseJSON(chartApiData.users);

        var ticketType = '<select id="types" name="types[]" class="uk-select" multiple style="width:100%">';
        for (i=0; i < $ticketTypes.length; i++) {
            var theType = $ticketTypes[i];
            ticketType += '<option value="'+ theType.id +'">'+ theType.name +'</option>';
        }
        ticketType += '</select>';

        var $toSelect = '<select id="to_select" name="to[]" class="uk-select" multiple style="width:100%">';
        for (i=0; i < $users.length; i++) {
            var theUser = $users[i];
            $toSelect += '<option value="'+ theUser.id +'">'+ theUser.name +'</option>';
        }
        $toSelect += '</select>';

        $groups = jQuery.parseJSON(chartApiData.groups);
        var $toGroup = '<select class="uk-select" id="to_group_select" name="groupsTo[]" multiple style="width:100%">';
            $toGroup += '<option value="0">SEND TO ALL</option>';
        $.each($groups, function($index, $group) {
            $toGroup += '<option value="'+$group.id+'">'+$group.groupName+'</option>';
        });
        $toGroup += '</select>';

        var modal = '<form class="open-ticket uk-form-horizontal" method="post" id="createticket" action="'+ chartApiData.createTicketUrl +'">' +
            '<input type="hidden" name="_token" value="'+ chartApiData._token +'"> ' +
            '<input type="hidden" name="projectId" value="'+ chartApiData.projectId +'"> ' +
            '<input type="hidden" name="idMedia" value="'+ idMedia +'" >' +
            '<input type="hidden" name="postDate" value="'+ postDate +'"> ' +
            '<input type="hidden" name="sentiment" value="'+ sentiment +'" >' +
            '<input type="hidden" name="postId" value="'+ postId +'">' +
            '<div  class="uk-modal-body">' +
                '<h5>Open New Ticket</h5>' +
                '<div class="uk-margin">' +
                    '<ul uk-tab>' +
                        '<li><a href="#">Send to User</a></li>' +
                        '<li><a href="#">Send to Group</a></li>' +
                    '</ul>' +
                    '<ul class="uk-switcher">' +
                        '<li>'+ $toSelect +'</li>' +
                        '<li>'+ $toGroup +'</li>' +
                    '</ul>' +
                '</div>' +
                '<div class="uk-margin">' +
                    ticketType +
                '</div>' +
                '<div class="uk-margin">' +
                    '<textarea class="uk-textarea" rows="3" placeholder="Additional message" name="message"></textarea>' +
                '</div>' +
                '<div class="uk-margin uk-flex uk-flex-right">' +
                    '<a class="uk-modal-close uk-button grey white-text uk-margin-small-right">CANCEL</a>' +
                    '<button class="uk-button uk-float-right red white-text" type="submit">SUBMIT</button>' +
                '</div>' +
            '</div>' +
        '</form>';
        var uikitModal = UIkit.modal.dialog(modal);

        $("#to_select").select2({
            tags: "true",
            placeholder: 'Select User',
            allowClear: true,
            dropdownParent: $('#createticket')
        });
        // $("#to_cc_select").select2();
        $('#to_group_select').select2({
            tags: "true",
            placeholder: 'Select Group',
            allowClear: true,
            dropdownParent: $('#createticket')
        });
        $('#types').select2({
            tags: "true",
            placeholder: 'Select Ticket Type',
            allowClear: true,
            dropdownParent: $('#createticket')
        });

        $( "#createticket" ).on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function ($res) {
                    if ($res == '1') {
                        UIkit.modal.dialog('<div class="uk-modal-body uk-text-center">Your ticket has been sent successfully!</div>');
                        theTable.ajax.reload('',false);
                        uikitModal.hide();
                    } else {
                        alert('A problem has been occured while submitting your ticket.');
                    }
                }
            })
        });
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

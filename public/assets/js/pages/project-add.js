(function ($, window, document) {
    $(function () {
        $('#project_add').validate({
            rules: {
                field_title: {
                    required: true
                },
                errorPlacement: function(error, element) {
                    if (element.attr('name') == 'field_title') {
                        $('#field_title').parent().append(error);
                    }
                }
            },
            submitHandler: function(form) {
                $( ".field-keyword" ).each(function( index ) {
                    var oldVal = $( this ).val();
                    var action = $(this).attr('data-prefix');
                    $(this).val(action + ' ' + oldVal);
                    console.log($(this).val(action + ' ' + oldVal));
                });
                $( ".field-topic" ).each(function( index ) {
                    var oldVal = $( this ).val();
                    var action = $(this).attr('data-prefix');
                    $(this).val(action + ' ' + oldVal);
                });
                $( ".field-noise" ).each(function( index ) {
                    var oldVal = $( this ).val();
                    var action = $(this).attr('data-prefix');
                    $(this).val(action + ' ' + oldVal);
                });
                // do other things for a valid form
                form.submit();
            }
        });

        // $('#project_add').on('submit', function(e) {
        //     e.preventDefault();
        //     $( ".field-keyword" ).each(function( index ) {
        //         var oldVal = $( this ).val();
        //         var action = $(this).attr('data-prefix');
        //         $(this).val(action + ' ' + oldVal);
        //         console.log($(this).val(action + ' ' + oldVal));
        //     });
        //     $( ".field-topic" ).each(function( index ) {
        //         var oldVal = $( this ).val();
        //         var action = $(this).attr('data-prefix');
        //         $(this).val(action + ' ' + oldVal);
        //     });
        //     $( ".field-noise" ).each(function( index ) {
        //         var oldVal = $( this ).val();
        //         var action = $(this).attr('data-prefix');
        //         $(this).val(action + ' ' + oldVal);
        //     });
        //     this.submit();
        // });

    });

}(window.jQuery, window, document));

var keyword = 'keyword';
var topic = 'topic';
var noise = 'noise';
var r = 1;
var c = 1;
$('#'+keyword).prepend(
    '<li>'
        + '<div class="row-item uk-grid-small uk-child-width-1-4@m" uk-grid>'
            + '<div class="uk-inline col-item">'
                + '<a class="uk-form-icon uk-form-icon-flip" uk-icon="icon: plus"></a>'
                + '<div uk-drop="offset:0; pos:top-left;">'
                    + '<ul class="uk-iconnav sm-icon-nav">'
                        + '<li><a onclick="addColOR(this,'+r+','+keyword+')" class="uk-icon-button white-text blue">OR</a></li>'
                        + '<li><a onclick="addColAND(this,'+r+','+keyword+')" class="uk-icon-button white-text green">AND</a></li>'
                        + '<li><a onclick="addColNOT(this,'+r+','+keyword+')" class="uk-icon-button white-text red">NOT</a></li>'
                    + '</ul>'
                + '</div>'
                + '<input class="uk-input field-'+keyword+'" name="field_'+keyword+'['+r+']['+c+']" type="text" placeholder="'+keyword+'" data-prefix="">'
            + '</div>'
        + '</div>'
    +'</li>'
);
$('#'+topic).prepend(
    '<li>'
        + '<div class="row-item uk-grid-small uk-child-width-1-4@m" uk-grid>'
            + '<div class="uk-inline col-item">'
                + '<a class="uk-form-icon uk-form-icon-flip" uk-icon="icon: plus"></a>'
                + '<div uk-drop="offset:0; pos:top-left;">'
                    + '<ul class="uk-iconnav sm-icon-nav">'
                        + '<li><a onclick="addColOR(this,'+r+','+topic+')" class="uk-icon-button white-text blue">OR</a></li>'
                        + '<li><a onclick="addColAND(this,'+r+','+topic+')" class="uk-icon-button white-text green">AND</a></li>'
                        + '<li><a onclick="addColNOT(this,'+r+','+topic+')" class="uk-icon-button white-text red">NOT</a></li>'
                    + '</ul>'
                + '</div>'
                + '<input class="uk-input field-'+topic+'" name="field_'+topic+'['+r+']['+c+']" type="text" placeholder="'+topic+'" data-prefix="">'
            + '</div>'
        + '</div>'
    +'</li>'
);
$('#'+noise).prepend(
    '<li>'
        + '<div class="row-item uk-grid-small uk-child-width-1-4@m" uk-grid>'
            + '<div class="uk-inline col-item">'
                + '<a class="uk-form-icon uk-form-icon-flip" uk-icon="icon: plus"></a>'
                + '<div uk-drop="offset:0; pos:top-left;">'
                    + '<ul class="uk-iconnav sm-icon-nav">'
                        + '<li><a onclick="addColOR(this,'+r+','+noise+')" class="uk-icon-button white-text blue">OR</a></li>'
                        + '<li><a onclick="addColAND(this,'+r+','+noise+')" class="uk-icon-button white-text green">AND</a></li>'
                        + '<li><a onclick="addColNOT(this,'+r+','+noise+')" class="uk-icon-button white-text red">NOT</a></li>'
                    + '</ul>'
                + '</div>'
                + '<input class="uk-input field-'+noise+'" name="field_'+noise+'['+r+']['+c+']" type="text" placeholder="'+noise+'" data-prefix="">'
            + '</div>'
        + '</div>'
    +'</li>'
);

function addRowItem(wrapper) {
    r = $('#'+wrapper).find('.row-item').length + 1;
    c = 1;
    $('#'+wrapper).append(
        '<li>'
            + '<div class="row-item uk-grid-small uk-child-width-1-4@m" uk-grid>'
                + '<div class="uk-inline col-item">'
                    + '<a class="uk-form-icon uk-form-icon-flip" uk-icon="icon: plus"></a>'
                    + '<div uk-drop="offset:0; pos:top-left;">'
                        + '<ul class="uk-iconnav sm-icon-nav">'
                            + '<li><a onclick="addColOR(this,'+r+','+wrapper+')" class="uk-icon-button white-text blue">OR</a></li>'
                            + '<li><a onclick="addColAND(this,'+r+','+wrapper+')" class="uk-icon-button white-text green">AND</a></li>'
                            + '<li><a onclick="addColNOT(this,'+r+','+wrapper+')" class="uk-icon-button white-text red">NOT</a></li>'
                        + '</ul>'
                    + '</div>'
                    + '<input class="uk-input field-'+wrapper+'" name="field_'+wrapper+'['+r+']['+c+']" type="text" placeholder="'+wrapper+'" data-prefix="">'
                + '</div>'
            + '</div>'
            + '<a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove this '+wrapper+'" uk-tooltip></a>'
        +'</li>'
    );
}
function delRowItem(e) {
    $(e).closest('li').remove();
}
function delColItem(e) {
    $(e).closest('.col-item').remove();
}
function addColOR(e,r,wrapper) {
    c = $(e).closest('.row-item').find('.col-item').length + 1;
    $(e).closest('.row-item').append(
        '<div class="uk-inline col-item">'
            + '<span class="sm-form-prefix sm-text-bold blue-text">OR</span>'
            + '<a class="uk-form-icon uk-form-icon-flip add-col-item" uk-icon="icon: minus" onclick="delColItem(this)"></a>'
            + '<input class="uk-input field-'+wrapper+'" name="field_'+wrapper+'['+r+']['+c+']" type="text" placeholder="'+wrapper+'" data-prefix="OR">'
        + '</div>'
    );
}
function addColAND(e,r,wrapper) {
    c = $(e).closest('.row-item').find('.col-item').length + 1;
    $(e).closest('.row-item').append(
        '<div class="uk-inline col-item">'
            + '<span class="sm-form-prefix sm-text-bold green-text">AND</span>'
            + '<a class="uk-form-icon uk-form-icon-flip add-col-item" uk-icon="icon: minus" onclick="delColItem(this)"></a>'
            + '<input class="uk-input field-'+wrapper+'" name="field_'+wrapper+'['+r+']['+c+']" type="text" placeholder="'+wrapper+'" data-prefix="AND">'
        + '</div>'
    );
}
function addColNOT(e,r,wrapper) {
    c = $(e).closest('.row-item').find('.col-item').length + 1;
    $(e).closest('.row-item').append(
        '<div class="uk-inline col-item">'
            + '<span class="sm-form-prefix sm-text-bold red-text">NOT</span>'
            + '<a class="uk-form-icon uk-form-icon-flip add-col-item" uk-icon="icon: minus" onclick="delColItem(this)"></a>'
            + '<input class="uk-input field-'+wrapper+'" name="field_'+wrapper+'['+r+']['+c+']" type="text" placeholder="'+wrapper+'" data-prefix="NOT">'
        + '</div>'
    );
}

var advkeyword = 'adv_keyword';
var advtopic = 'adv_topic';
var advnoise = 'adv_noise';

$('#'+advkeyword).prepend(
    '<li>'
        + '<textarea class="uk-textarea field-'+advkeyword+'" rows="6" name="field_'+advkeyword+'['+r+']"></textarea>'
    +'</li>'
);

$('#'+advtopic).prepend(
    '<li>'
        + '<textarea class="uk-textarea field-'+advtopic+'" rows="6" name="field_'+advtopic+'['+r+']"></textarea>'
    +'</li>'
);

$('#'+advnoise).prepend(
    '<li>'
        + '<textarea class="uk-textarea field-'+advnoise+'" rows="6" name="field_'+advnoise+'['+r+']"></textarea>'
    +'</li>'
);
function addRowAdv(wrapper) {
    r = $('#'+wrapper).find('li').length + 1;
    $('#'+wrapper).append(
        '<li>'
            + '<textarea class="uk-textarea field-'+wrapper+'" rows="6" name="field_'+wrapper+'['+r+']"></textarea>'
            + '<a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove this Field" uk-tooltip></a>'
        +'</li>'
    );
}
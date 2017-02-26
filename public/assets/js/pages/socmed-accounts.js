(function ($, window, document) {
    $(function () {
        $('#socmed_acc').on('submit', function(e) {
            e.preventDefault();
            this.submit();
        });
    });

}(window.jQuery, window, document));

var facebook = 'facebook';
var twitter = 'twitter';
var youtube = 'youtube';
var instagram = 'instagram';
var r = 1;
$('#'+facebook).prepend(
    '<li>'
        + '<input class="uk-input field-'+facebook+'" name="field_'+facebook+'['+r+']" type="text" placeholder="'+facebook+'">'
    +'</li>'
);
$('#'+twitter).prepend(
    '<li>'
        + '<input class="uk-input field-'+twitter+'" name="field_'+twitter+'['+r+']" type="text" placeholder="'+twitter+'">'
    +'</li>'
);
$('#'+youtube).prepend(
    '<li>'
        + '<input class="uk-input field-'+youtube+'" name="field_'+youtube+'['+r+']" type="text" placeholder="'+youtube+'">'
    +'</li>'
);
$('#'+instagram).prepend(
    '<li>'
        + '<input class="uk-input field-'+instagram+'" name="field_'+instagram+'['+r+']" type="text" placeholder="'+instagram+'">'
    +'</li>'
);

function addRowItem(wrapper) {
    r = $('#'+wrapper).find('li').length + 1;
    $('#'+wrapper).append(
        '<li>'
            + '<input class="uk-input field-'+wrapper+'" name="field_'+wrapper+'['+r+']" type="text" placeholder="'+wrapper+'" data-prefix="">'
            + '<a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove this account" uk-tooltip></a>'
        +'</li>'
    );
}
function delRowItem(e) {
    $(e).closest('li').remove();
}
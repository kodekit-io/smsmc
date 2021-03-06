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
// $('#'+facebook).prepend(
//     '<li>'
//         + '<input class="uk-input field-'+facebook+'" name="field_'+facebook+'['+r+']" type="text" placeholder="'+facebook+'">'
//     +'</li>'
// );
// $('#'+twitter).prepend(
//     '<li>'
//         + '<input class="uk-input field-'+twitter+'" name="field_'+twitter+'['+r+']" type="text" placeholder="'+twitter+'">'
//     +'</li>'
// );
// $('#'+youtube).prepend(
//     '<li>'
//         + '<input class="uk-input field-'+youtube+'" name="field_'+youtube+'['+r+']" type="text" placeholder="'+youtube+'">'
//     +'</li>'
// );
// $('#'+instagram).prepend(
//     '<li>'
//         + '<input class="uk-input field-'+instagram+'" name="field_'+instagram+'['+r+']" type="text" placeholder="'+instagram+'">'
//     +'</li>'
// );

function addRowItem(wrapper) {
    latestLi = $('#'+wrapper).find('li').last();
    // console.log(latestLi.attr('data-id'));
    // r = $('#'+wrapper).find('li').length + 1;
    r = parseInt(latestLi.attr('data-id')) + 1;

    $('#'+wrapper).append(
        '<li class="uk-position-relative" data-id="'+r+'"> \
            <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid> \
                <div class="uk-width-auto"><div class="sm-number">'+r+'</div></div> \
                <div class="uk-width-expand"><input class="uk-input field-'+wrapper+'" name="field_'+wrapper+'['+r+']" type="text" placeholder="'+wrapper+'"></div> \
                <div class="uk-width-auto"><a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove '+wrapper+' '+r+'" uk-tooltip uk-hidden></a></div> \
            </div> \
        </li>'
    );
}
function delRowItem(e) {
    $(e).closest('li').find('input').val('');
    $.when($(e).closest('li').find('input').val() == '').done(function( x ) {
        // $(e).closest('li').css('visibility','hidden');
        $(e).closest('li').css('display','none');
        //$(e).closest('li').remove();
    });
}

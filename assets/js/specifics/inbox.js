jQuery(document).ready(function ($) {
    $('#reply-box-form').submit(function (e) {
        e.preventDefault();
        if( !document.getElementById('reply-box').disabled ) {
            $.post(base_url('messaging/send'), $(this).serialize(),function (data) {
                var data = $.parseJSON(data);
                console.log(data);
                if (data.type == "success") {
                    message_sent_animation(data, '#display-messages');
                    $('#messages-main a[data-msisdn="'+data.msisdn+'"]').click();
                    $('#reply-box').val('');
                }
            });
        }
    });
});
jQuery(document).on('click', '[data-contact]', function (e) {
    var Ds = $(this),
        _msisdn  = Ds.data('msisdn'),
        _msgBox = $('#inbox-conversation-viewer'),
        _contactNames = Ds.find('.contact-name'),
        _contactNameOnMsgBox = _msgBox.find('#inbox-conversation-viewer-contact-name'),
        _replyBox = $('#reply-box');

    $('[data-contact]').removeClass('active');
    $.post(base_url('messaging/inbox/'+_msisdn), function (data) {
        var data = $.parseJSON(data);

        $('#display-messages').html( build_message_html(data.inbox) );
        Ds.toggleClass('active');

        var contacts = [];
        for (var i = 0; i < _contactNames.length; i++) {
            contacts.push( $(_contactNames[i]).text() );
        }
        var _contact = truncate(contacts.join(', '), 50);
        _msgBox.attr('data-contact-msisdn', _msisdn);
        _replyBox.attr('disabled', false);
        _replyBox.attr('placeholder', 'Send SMS to ' + _contact + '...');
        $('[data-msisdn]').val(_msisdn);

        // $('#display-contact-name').html( data. )
        console.log(data);
    });
});

function build_message_html($message) {
    var h = "";
    for (var i = 0; i < $message.length; i++) {
        var _date = ( moment($message[i].created_at).format('MM/DD/YYYY') == moment().format('MM/DD/YYYY') ? 'Today' : moment($message[i].created_at).format('MM/DD/YYYY') ) + ' at ' + moment($message[i].created_at).format('hh:mma');
        h += '<div class="lv-item media '+("outbox"==$message[i].table_name?'right':'')+'" data-msisdn="'+($message[i].msisdn)+'" >';
            h += '<div class="media-body">';
                h += '<div class="ms-item">'+$message[i].body+'</div>';
                h += '<small class="ms-date"><i class="zmdi zmdi-time">&nbsp;</i>'+_date+'</small>';
            h += '</div>';
        h += '</div>';
    }
    return h;
}

function message_sent_animation(html, append) {
    var _html = $('<div class="lv-item media right" />');
    _html.html('<div class="media-body"><div class="ms-item">'+html.body+'</div><small class="ms-date"><i class="zmdi zmdi-time">&nbsp;</i>'+html.date+'</small></div>');
    $(append).append(_html);
}
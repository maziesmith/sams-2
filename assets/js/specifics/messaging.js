jQuery(document).ready(function ($) {
    $('.input-selectize').each(function (e) {
        console.log($(this).data('jsoned'));
        $(this).selectize({
            plugins: ['remove_button', 'restore_on_backspace'],
            delimiter: $(this).data('selectize-delimiter') ? $(this).data('selectize-delimiter') : ',',
            options: [],
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    name: input,
                    msisdn: input
                }
            },

            valueField: 'msisdn',
            labelField: 'name',
            searchField: ['name', 'msisdn'],

            render: {
                item: function(item, escape) {
                    console.log(item);
                    var caption = item.name ? item.name : item.msisdn;
                    return '<div><span class="name">' + escape(caption) + '</span></div>';
                },
                option: function(item, escape) {
                    console.log(item);
                    var label = item.name || item.msisdn;
                    var caption = item.name ? item.msisdn : null;
                    return '<div>' +
                        '<strong>' + escape(label) + '</strong>' +
                        (caption ? '<div class="caption text-muted">' + escape(caption) + '</div>' : '') +
                    '</div>';
                }
            },
            load: function (query, callback) {
                if (!query.length) return callback();
                $.get(base_url('messaging/new'), function (data) {
                    console.log($.parseJSON(data));
                    callback($.parseJSON(data));
                });
            },
        });
    });
    // $('.my-input-selectize').selectize({
    //     plugins: ['remove_button', 'restore_on_backspace'],
    //     delimiter: $(this),
    //     create: function(input) {
    //         return {
    //             value: input,
    //             name: input
    //         }
    //     }
    // });
})
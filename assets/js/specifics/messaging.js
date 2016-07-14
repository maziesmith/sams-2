jQuery(document).ready(function ($) {
    $('.input-selectize').each(function (e) {
        $(this).selectize({
            plugins: ['remove_button', 'restore_on_backspace'],
            delimiter: $(this).data('selectize-delimiter') ? $(this).data('selectize-delimiter') : ',',
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            }
        });
    });
    // $('.my-input-selectize').selectize({
    //     plugins: ['remove_button', 'restore_on_backspace'],
    //     delimiter: $(this),
    //     create: function(input) {
    //         return {
    //             value: input,
    //             text: input
    //         }
    //     }
    // });
})
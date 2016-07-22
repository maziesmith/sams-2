jQuery(document).ready(function ($) {
    init_table();
    var refresher = setInterval(function () {
        reload_tracking_table();
    }, 1500);
    setTimeout(function() {
        clearInterval(refresher);
    }, 1800000);
});

function reload_tracking_table() {
    $("#messaging-tracking-table").bootgrid('reload');
}
function init_table () {
    /*
    | ------------------------------------
    | # Add
    | ------------------------------------
    */
    $("#messaging-tracking-table").bootgrid({
        labels: {
            noResults: 'No Message found',
        },
        css: {
            icon: 'zmdi icon',
            iconColumns: 'zmdi-view-module',
            iconDown: 'zmdi-caret-down',
            iconRefresh: 'zmdi-refresh',
            iconUp: 'zmdi-caret-up',
        },

        ajax: true,
        ajaxSettings: {
            method: "POST",
            cache: true,
        },
        requestHandler: function (request)
        {
            // To accumulate custom parameter with the request object
            // request.customPost = 'anything';
            // console.log(request);
            // request.selectedRows = $('.contacts-table-command').bootgrid('getSelectedRows');
            // console.log('request');
            // console.log(request);
            return request;
        },
        responseHandler: function (response) {
            console.log(response);
            return response;
        },
        url: base_url('messages/tracking-listing'),
        rowCount: [5, 10, 20, 30, 50, 100, -1],
        keepSelection: true,

        selection: false,
        multiSelect: true,
        caseSensitive: false,
    }).on("loaded.rs.jquery.bootgrid", function (e) {
        reload_dom();
    });
}

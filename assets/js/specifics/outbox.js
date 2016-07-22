jQuery(document).ready(function ($) {
    /*
    |---------------
    | # Outbox Table
    |---------------
    */
    init_outbox_table();
    var refresher = setInterval(function () {
        reload_outbox_table();
    }, 1500);
    setTimeout(function() {
        clearInterval(refresher);
    }, 1800000);
});

function reload_outbox_table()
{
    console.log("refresh");
    $('#outbox-table').bootgrid('reload');
}
function init_outbox_table() {
    var trashCount = 0;
    contactTable = $("#outbox-table").bootgrid({
        labels: {
            loading: '<i class="zmdi zmdi-close zmdi-hc-spin"></i>',
            noResults: 'No Sent Messages',
        },
        css: {
            icon: 'zmdi icon',
            iconColumns: 'zmdi-view-module',
            iconDown: 'zmdi-caret-down',
            iconRefresh: 'zmdi-refresh',
            iconUp: 'zmdi-caret-up',
        },
        // formatters: {
        //     commands: function (column, row) {
        //         return  '<button role="button" class="wave-effect btn btn-icon command-edit"    data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button> ' +
        //                 '<button type="button" class="wave-effect btn btn-icon command-delete"  data-row-id="' + row.id + '"><span class="zmdi zmdi-delete"></span></button> ';
        //     }
        // },

        ajax: true,
        ajaxSettings: {
            method: "POST",
            cache: false
        },
        requestHandler: function (request)
        {
            // To accumulate custom parameter with the request object
            // request.customPost = 'anything';
            // request.current = 2;
            // console.log(request);
            return request;
        },
        responseHandler: function (response)
        {
            // To accumulate custom parameter with the response object
            // response.customPost = 'anything';
            // response.current = 2;
            trashCount = response.trash.count;
            return response;
        },
        url: base_url('messaging/listing'),
        rowCount: [5, 10, 20, 30, 50, 100, 500, -1],
        // keepSelection: true,

        // selection: true,
        // multiSelect: true,

        caseSensitive: false,
    }).on("loaded.rs.jquery.bootgrid", function (e) {
        reload_dom();
        $('.trash-count').text(trashCount);
        contactTable.find('td.status:contains("success")').parent().addClass('success');
    });
}
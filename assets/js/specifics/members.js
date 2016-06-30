var memberTable;
var G_selectedRows = [];
$(document).ready(function(){
    /*
    | --------------------------------------------
    | # Listing
    | --------------------------------------------
    */
    init_table();


    /*
    | --------------------------------------------
    | # Add
    | --------------------------------------------
    | # Validate | Submit
    */
    var $memberForm = $('#add-new-member-form').validate({
        rules: {
            firstname: 'required',
            lastname: 'required',
            address_street: 'required',
            address_brgy: 'required',
            address_city: 'required',
            msisdn: 'required',
            email: {
                'required': true,
                'email': true
            }
        },
        messages: {
            firstname: {
                'required': "The First Name field is required"
            },
            lastname: {
                'required': "The Last Name field is required"
            },
            address_street: {
                'required': "The Street field is required"
            },
            address_brgy: {
                'required': "The Subdivision/Brgy field is required"
            },
            address_city: {
                'required': "The Town / City field is required"
            },
            msisdn: {
                'required': "The Mobile field is required"
            },
            email: {
                'required': "The Email field is required",
                'email': "The Email field must contain a valid email address"
            },
        },
        errorElement: 'small',
        errorPlacement: function (error, element) {
            $(error).addClass('help-block');
            $(element).parents('.form-group-validation').addClass('has-warning').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group-validation').addClass('has-warning');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group-validation').removeClass('has-warning');
            $(element).parents('.form-group-validation').find('.help-block').remove();
        },
        submitHandler: function (form) {
            var add = {
                type: form.method,
                url: form.action,
                data: $(form).serialize(),
                success: function (data) {
                    data = JSON.parse(data);
                    resetWarningMessages('.form-group-validation');
                    if( data.type !== 'success' )
                    {
                        var errors = data.message;

                        $.each(errors, function (k, v) {
                            $('#add-new-member-form').find('input[name='+k+'], select[name='+k+']').parents('.form-group-validation').addClass('has-warning').append('<small class="help-block">'+v+'</small>');
                            // console.log(k,v);
                        });
                    }
                    else
                    {
                        notify(data.message, data.type, 9000);
                        $('#add-new-member-form')[0].reset();
                        $('#add-new-member-form [name=firstname]').focus();
                        reload_table();
                        reload_selectpickers();
                    }
                    console.log(data);
                },
                dataType: 'html',
            };
            $.ajax({
                type: add.type,
                url: add.url,
                data: add.data,
                success: add.success
            });
        }
    })
    /*
    | ---------------------------------------
    | # Delete Many
    | ---------------------------------------
    */
    $('body').on('click', '#delete-member-btn', function (e) {
        e.preventDefault();
        // console.log(G_selectedRows);
        var url  =  base_url('members/remove');
        swal({
            title: "Are you sure?",
            text: "The selected Members will be removed from your record",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            closeOnConfirm: false,
        }, function(){
            $.ajax({
                type: 'POST',
                url: url,
                data: {'id[]': $("#member-table-command").bootgrid('getSelectedRows')},
                success: function (data) {
                    // console.log(data);
                    var data = $.parseJSON(data);
                    reload_table();
                    swal("Removed", data.member.message, data.member.type);
                    G_selectedRows = [];
                    $('#delete-member-btn').removeClass('show');
                },
            });
        });

    })
    /*
    | --------------------------------------------
    | # Update
    | --------------------------------------------
    */
    $('#edit-member-form').validate({
        rules: {
            firstname: 'required',
            lastname: 'required',
            address_street: 'required',
            address_brgy: 'required',
            address_city: 'required',
            msisdn: 'required',
            email: {
                'required': true,
                'email': true
            }
        },
        messages: {
            firstname: {
                'required': "The First Name field is required"
            },
            lastname: {
                'required': "The Last Name field is required"
            },
            address_street: {
                'required': "The Street field is required"
            },
            address_brgy: {
                'required': "The Subdivision/Brgy field is required"
            },
            address_city: {
                'required': "The Town / City field is required"
            },
            msisdn: {
                'required': "The Mobile field is required"
            },
            email: {
                'required': "The Email field is required",
                'email': "The Email field must contain a valid email address"
            },
        },
        errorElement: 'small',
        errorPlacement: function (error, element) {
            $(error).addClass('help-block');
            $(element).parents('.form-group-validation').addClass('has-warning').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group-validation').addClass('has-warning');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group-validation').removeClass('has-warning');
            $(element).parents('.form-group-validation').find('.help-block').remove();
        },
        submitHandler: function (form) {
            var id = $(form).find('[name=id]').val();
            if( id === 'AJAX_CALL_ONLY' ) {
                swal("Error", "The Member's ID is invalid. Please reload the page and try again.", 'error');
                $('[name=close]').click();
            } else {
                $.ajax({
                    type: 'POST',
                    url: $(form).attr('action') + '/' + id,
                    data: $(form).serialize(),
                    success: function (data) {
                        data = JSON.parse(data);
                        console.log(data);
                        resetWarningMessages('.form-group-validation');
                        if( data.type != 'success' ) {
                            var errors = data.message;
                            $.each(errors, function (k, v) {
                                $('#edit-member-form').find('input[name='+k+'], select[name='+k+']').parents('.form-group-validation').addClass('has-warning').append('<small class="help-block">'+v+'</small>');
                            });
                        } else {
                            $('#edit-member-form').find('button[name=close]').delay(900).queue(function(next){ $(this).click(); next(); });
                            notify(data.message, data.type, 9000);
                            reload_table();
                            $('#edit-member-form')[0].reset();
                            reload_selectpickers();
                        }
                    },
                });
            }

        }
    });

});


function reload_table()
{
    $('#member-table-command').bootgrid('reload');
}
function init_table() {
    var selectedRowCount = [];
    memberTable = $("#member-table-command").bootgrid({
        labels: {
            loading: '<i class="zmdi zmdi-close zmdi-hc-spin"></i>',
            noResults: 'No Members found',
        },
        css: {
            icon: 'zmdi icon',
            iconColumns: 'zmdi-view-module',
            iconDown: 'zmdi-caret-down',
            iconRefresh: 'zmdi-refresh',
            iconUp: 'zmdi-caret-up',
        },
        formatters: {
            commands: function (column, row) {
                return  '<button role="button" class="wave-effect btn btn-icon command-edit"    data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button> ' +
                        '<!--<button type="button" class="wave-effect btn btn-icon command-refresh" data-row-id="' + row.id + '"><span class="zmdi zmdi-search-for"></span></button>-->' +
                        '<button type="button" class="wave-effect btn btn-icon command-delete"  data-row-id="' + row.id + '"><span class="zmdi zmdi-delete"></span></button> ' +
                        '<!--<button type="button" class="wave-effect btn btn-icon command-print"   data-row-id="' + row.id + '"><span class="zmdi zmdi-print"></span></button>-->';
            }
        },

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
            console.log(response);
            return response;
        },
        url: base_url('members/listing'),
        rowCount: [5, 10, 20, 30, 50, 100, -1],
        keepSelection: true,

        selection: true,
        multiSelect: true,

        caseSensitive: false,
    }).on('appended.rs.jquery.bootgrid', function (e, arr) {
        // console.log(arr);
    }).on("selected.rs.jquery.bootgrid", function(e, rows)
    {
        selectedRowCount.push(rows);
        G_selectedRows.push(rows[0].id);
        // console.log(selectedRowCount);
        if( selectedRowCount.length >= 2 )
        {
            $('#delete-member-btn').addClass('show');
        } else {
            $('#delete-member-btn').removeClass('show');
        }
    }).on("deselected.rs.jquery.bootgrid", function(e, rows)
    {
        selectedRowCount.splice(-1, 1);
        G_selectedRows.splice(-1, 1);

        // console.log(selectedRowCount);
        if( selectedRowCount.length >= 2 )
        {
            $('#delete-member-btn').addClass('show');
        } else {
            $('#delete-member-btn').removeClass('show');
        }

    }).on("loaded.rs.jquery.bootgrid", function (e) {
        reload_dom();
        /*
        | ---------------------------------
        | # Checkbox
        | ---------------------------------
        */
        $('.select-box[value="all"]').click(function(){
            var select_all = $('.select-box[value="all"]:checked').length;
            if( select_all > 0 )
            {
                selectedRowCount.push(1);
                if( selectedRowCount.length >= 2 )
                {
                    $('#delete-member-btn').addClass('show');
                } else {
                    $('#delete-member-btn').removeClass('show');
                }
            } else {
                selectedRowCount.splice(-1, selectedRowCount.length-1);
            }
        });
        /*
        | -----------------------------------------------------------
        | # Edit
        | -----------------------------------------------------------
        */
        memberTable.find(".command-edit").on("click", function () {
            var id = $(this).parents('tr').data('row-id'),
                url = base_url('members/edit/' + id);

            $.ajax({
                type: 'POST',
                url: url,
                data: {id: id},
                success: function (data) {
                    var member = $.parseJSON(data);
                    $('#edit-member').modal("show");
                    var _form = $('#edit-member-form');

                    $.each(member, function (k, v) {
                        _form.find('[name=' + k + ']').val( v ).parent().addClass('fg-toggled');
                        if( k == 'type' ) reload_selectpickers_key( k, v);
                        if( k == 'groups' ) reload_selectpickers_key( k+"[]", v);
                        if( k == 'level' ) reload_selectpickers_key( k, v);
                    });
                }
            });
        });

        /*
        | -----------------------------------------------------------
        | # Delete
        | -----------------------------------------------------------
        */
        memberTable.find(".command-delete").on("click", function (e) {
            var id   = $(this).parents('tr').data('row-id'),
                name = $(this).parents('tr').find('td.fullname').text(),
                url  = base_url('members/remove/' + id);
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: name + " will be trashed.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Delete",
                closeOnConfirm: false
            }, function(){
                // on deleting button
                $.ajax({
                    type: 'POST',
                    url: url,
                    success: function (data) {
                        var data = $.parseJSON(data);
                        console.log(data);
                        reload_table();
                        swal("Removed", data.member.message, data.member.type);
                    }
                });
            });
        });

    });
}
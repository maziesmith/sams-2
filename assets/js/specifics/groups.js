var groupTable;
var G_selectedGroupRows = [];
$(document).ready(function() {
    /*
    | ----------------------------------
    | # Listing
    | ----------------------------------
    */
    init_group_table();

    /*
    | ----------------------------------
    | # Add New Group
    | ----------------------------------
    | # Validate | Submit
    */
    $('#add-new-group-btn').click(function () {
       init_add_group_table();
    });
    var $groupForm = $('#add-new-group-form').validate({
        rules: {
            groups_name: 'required',
            groups_code: 'required',
        },
        messages: {
            groups_name: {
                'required': "The Group Name field is required"
            },
            groups_code: {
                'required': "The Group Code field is required"
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
                data: $(form).serialize() + "&groups_contacts=" + $('#contacts-table-command-add').bootgrid('getSelectedRows'),
                success: function (data) {
                    data = JSON.parse(data);
                    resetWarningMessages('.form-group-validation');
                    if( data.type !== 'success' )
                    {
                        var errors = data.message;

                        $.each(errors, function (k, v) {
                            $('#add-new-group-form').find('input[name='+k+'], select[name='+k+']').parents('.form-group-validation').addClass('has-warning').append('<small class="help-block">'+v+'</small>');
                            console.log(k,v);
                        });
                    }
                    else
                    {
                        // console.log(data);
                        notify(data.message, data.type, 9000);
                        $('#add-new-group-form')[0].reset();
                        $('#add-new-group-form [name=groups_name]').focus();
                        reload_group_table();
                    }
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
    });
    /*
    | ----------------------------------
    | # Update Group
    | ----------------------------------
    */
    $('#edit-group-form').validate({
        rules: {
            groups_name: 'required',
            groups_code: 'required',
        },
        messages: {
            groups_name: {
                'required': "The Group Name field is required"
            },
            groups_code: {
                'required': "The Group Code field is required"
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
            var groups_id = $(form).find('[name=groups_id]').val();
            if( groups_id === 'AJAX_CALL_ONLY' ) {
                swal("Error", "The Group's ID is invalid. Please reload the page and try again.", 'error');
                $('[name=groups_close]').click();
            } else {
                $.ajax({
                    type: 'POST',
                    url: $(form).attr('action') + '/' + groups_id,
                    data: $(form).serialize() + "&groups_contacts=" + $('#contacts-table-command-edit').bootgrid('getSelectedRows'),
                    success: function (data) {
                        data = JSON.parse(data);
                        // console.log(data);
                        resetWarningMessages('.form-group-validation');
                        if( data.type != 'success' )
                        {
                            var errors = data.message;
                            $.each(errors, function (k, v) {
                                $('#edit-group-form').find('input[name='+k+'], select[name='+k+']').parents('.form-group-validation').addClass('has-warning').append('<small class="help-block">'+v+'</small>');
                            });
                        }
                        else
                        {
                            console.log(data);
                            $('#edit-group-form').find('button[name=groups_close]').delay(900).queue(function(next){ $(this).click(); next(); });
                            notify(data.message, data.type, 9000);
                            reload_group_table();
                            $('#edit-group-form')[0].reset();
                            $('select').trigger("chosen:updated");
                        }
                    },
                });
            }
        }
    });
    /*
    | ---------------------------------------
    | # Delete Many
    | ---------------------------------------
    */
    $('body').on('click', '#delete-group-btn', function (e) {
        e.preventDefault();
        // console.log(G_selectedGroupRows);
        var url  = $('#group-table-command-delete-many-button').val();
        swal({
            title: "Are you sure?",
            text: "The selected Groups will be deleted permanently from your record",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            closeOnConfirm: false,
        }, function(){
            $.ajax({
                type: 'POST',
                url: url,
                data: {'groups_ids[]': G_selectedGroupRows},
                success: function (data) {
                    console.log(G_selectedGroupRows);
                    var data = $.parseJSON(data);
                    reload_group_table();
                    swal("Deleted", data.message, data.type);
                    G_selectedGroupRows = [];
                    $('#delete-group-btn').removeClass('show');
                },
            });
        });

    });

    /*
    | ----------------------------------
    | # Group Code Suggestion
    | ----------------------------------
    */
    $('input[name=groups_name]').on('keyup', function () {
        $('input[name=groups_code]').val( slugify( $(this).val() ) ).parent().addClass('fg-toggled');
    });
});

function reload_group_table () {
    $('#group-table-command').bootgrid('reload');
    $('.contacts-table-command').bootgrid('reload');
}

function init_group_table()
{
    var selectedGroupRowCount = [];
    groupTable = $("#group-table-command").bootgrid({
        labels: {
            loading: '<i class="zmdi zmdi-close zmdi-hc-spin"></i>',
            noResults: 'No Groups found',
        },
        css: {
            icon: 'zmdi icon',
            iconColumns: 'zmdi-view-module',
            iconDown: 'zmdi-expand-more',
            iconRefresh: 'zmdi-refresh',
            iconUp: 'zmdi-expand-less',
        },
        formatters: {
            commands: function (column, row) {
                return  '<button role="button" class="wave-effect btn btn-icon command-edit"    data-row-id="' + row.groups_id + '"><span class="zmdi zmdi-edit"></span></button> ' +
                        '<button type="button" class="wave-effect btn btn-icon command-delete"  data-row-id="' + row.groups_id + '"><span class="zmdi zmdi-delete"></span></button> ';
            }
        },

        ajax: true,
        ajaxSettings: {
            method: "POST",
            cache: false,
        },
        requestHandler: function (request)
        {
            // To accumulate custom parameter with the request object
            // request.customPost = 'anything';
            // console.log(request);
            return request;
        },
        url: $('#group-table-command-list').val(),
        rowCount: [5, 10, 20, 30, 50, 100, -1],
        keepSelection: true,

        multiSort: true,
        selection: true,
        multiSelect: true,
        // rowSelect: true,
        caseSensitive: false,
    }).on('appended.rs.jquery.bootgrid', function (e, arr) {
        // console.log(arr);
    }).on("selected.rs.jquery.bootgrid", function(e, rows)
    {
        // console.log(rows);
        selectedGroupRowCount.push(rows);
        G_selectedGroupRows.push(rows[0].groups_id);
        // console.log(G_selectedGroupRows);
        if( selectedGroupRowCount.length >= 2 )
        {
            $('#delete-group-btn').addClass('show');
        } else {
            $('#delete-group-btn').removeClass('show');
        }
    }).on("deselected.rs.jquery.bootgrid", function(e, rows)
    {
        selectedGroupRowCount.splice(-1, 1);
        G_selectedGroupRows.splice(-1, 1);

        // console.log(selectedGroupRowCount);
        if( selectedGroupRowCount.length >= 2 )
        {
            $('#delete-group-btn').addClass('show');
        } else {
            $('#delete-group-btn').removeClass('show');
        }

    }).on("loaded.rs.jquery.bootgrid", function (e) {
        /*
        | ---------------------------------
        | # Checkbox
        | ---------------------------------
        */
        $('.select-box[value="all"]').click(function(){
            var select_all = $('.select-box[value="all"]:checked').length;
            if( select_all > 0 )
            {
                selectedGroupRowCount.push(1);
                if( selectedGroupRowCount.length >= 2 )
                {
                    $('#delete-group-btn').addClass('show');
                } else {
                    $('#delete-group-btn').removeClass('show');
                }
            } else {
                selectedGroupRowCount.splice(-1, selectedGroupRowCount.length-1);
            }
        });
        /*
        | -----------------------------------------------------------
        | # Edit
        | -----------------------------------------------------------
        */
        groupTable.find(".command-edit").on("click", function () {
            var groups_id = $(this).parents('tr').data('row-id'),
                url = $('#group-table-command-edit').val() + '/' + groups_id;

            $.ajax({
                type: 'POST',
                url: url,
                data: {groups_id: groups_id},
                success: function (data) {
                    var group = $.parseJSON(data);
                    $('#edit-group').modal("show");
                    var _form = $('#edit-group-form');

                    $.each(group, function (k, v) {
                        _form.find('[name=' + k + ']').val( v ).parent().addClass('fg-toggled');
                        $('select').trigger("chosen:updated");
                    });

                    init_edit_group_table();
                }
            });
        });

        /*
        | -----------------------------------------------------------
        | # Delete
        | -----------------------------------------------------------
        */
        groupTable.find(".command-delete").on("click", function (e) {
            var id   = $(this).parents('tr').data('row-id'),
                name = $(this).parents('tr').find('td.groups_name').text(),
                url  = $('#group-table-command-delete-button').val() + '/' + id;
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: name + " will be deleted permanently from your groups",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Delete",
                closeOnConfirm: false
            }, function(){
                // on deleting button
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    success: function (data) {
                        var data = $.parseJSON(data);
                        reload_group_table();
                        swal("Deleted", data.message, data.type);
                    }
                });
            });
        });
    });
}

function init_add_group_table () {
    /*
    | ------------------------------------
    | # Add
    | ------------------------------------
    */
    $("#contacts-table-command-add").bootgrid({
        labels: {
            noResults: 'No Contacts found',
        },
        css: {
            icon: 'zmdi icon',
            iconColumns: 'zmdi-view-module',
            iconDown: 'zmdi-expand-more',
            iconRefresh: 'zmdi-refresh',
            iconUp: 'zmdi-expand-less',
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
        url: $('#group-add-table-command-list').val(),
        rowCount: [5, 10, 20, 30, 50, 100, -1],
        keepSelection: true,

        selection: true,
        multiSelect: true,
        caseSensitive: false,
    });
}

function init_edit_group_table()
{
    /*
    | ------------------------------------
    | # Edit
    | ------------------------------------
    */
    var contactsTableCommandEdit = $("#contacts-table-command-edit").bootgrid({
        labels: {
            noResults: 'No Contacts found',
        },
        css: {
            icon: 'zmdi icon',
            iconColumns: 'zmdi-view-module',
            iconDown: 'zmdi-expand-more',
            iconRefresh: 'zmdi-refresh',
            iconUp: 'zmdi-expand-less',
        },
        formatters: {
            commands: function (column, row) {
                return  '<button type="button" title="Remove from list" class="wave-effect btn btn-icon command-delete"  data-row-id="' + row.contacts_id + '"><span class="zmdi zmdi-delete"></span></button> ';
            }
        },

        ajax: true,
        ajaxSettings: {
            method: "POST",
            cache: true,
        },
        requestHandler: function (request)
        {
            // To accumulate custom parameter with the request object
            // console.log(request);
            return request;
        },
        url: $('#contacts-table-command-edit-link').val() + '/' + $('#edit-group-form').find('[name=groups_id]').val(),
        rowCount: [5, 10, 20, 30, 50, 100, -1],
        // keepSelection: true,

        // selection: true,
        // multiSelect: true,
        // caseSensitive: false,
    }).on("loaded.rs.jquery.bootgrid", function (e) {
        /*
        | -----------------------------------------------------------
        | # Delete From List
        | -----------------------------------------------------------
        */
        contactsTableCommandEdit.find(".command-delete").on("click", function (e) {
            var id   = $(this).parents('tr').data('row-id'),
                name = $(this).parents('tr').find('td.contacts_name').text(),
                url  = $('#contacts-table-command-update-button').val() + '/' + id;
            e.preventDefault();
            notify('Please work on this now!', 'danger', 3000);
            // $.ajax({
            //     type: 'POST',
            //     url: url,
            //     data: { contacts_group: '' },
            //     success: function (data) {
            //         var data = $.parseJSON(data);
            //         reload_group_table();
            //         notify(data.message, data.type);
            //     }
            // });
        });
    });
}
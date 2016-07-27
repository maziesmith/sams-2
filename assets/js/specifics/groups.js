var groupTable;
$(document).ready(function() {
    /*
    | ----------------------------------
    | # Listing
    | ----------------------------------
    */
    init_group_table();
    init_add_group_table();
    // init_edit_group_members_table();

    /*
    | ----------------------------------
    | # Add New Group
    | ----------------------------------
    | # Validate | Submit
    */
    $('#add-new-group-btn').click(function () {
       init_add_group_table();
       $('#add-group').modal('hide');
        $.post(base_url('groups/check'), {"can":"groups/add"}, function (data) {
            var data = $.parseJSON(data);
            if (data.type == "error") {
                swal(data.title, data.message, data.type);
                $('#add-group').modal('hide');
            } else {
                $('#add-group').modal('show');
                $('#add-new-group-form')[0].reset();
                reload_selectpickers();
                $('#add-new-group-form [name=name]').focus();
            }
        });
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
                data: $(form).serialize() + "&groups_members=" + $('#members-table-command-add').bootgrid('getSelectedRows'),
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
                    data: $(form).serialize() + "&groups_members=" + $('#members-table-command-edit').bootgrid('getSelectedRows'),
                    success: function (data) {
                        data = JSON.parse(data);
                        console.log(data);
                        resetWarningMessages('.form-group-validation');
                        if( data.type != 'success' ) {
                            var errors = data.message;
                            $.each(errors, function (k, v) {
                                $('#edit-group-form').find('input[name='+k+'], select[name='+k+']').parents('.form-group-validation').addClass('has-warning').append('<small class="help-block">'+v+'</small>');
                            });
                        } else {
                            $('#edit-group-form').find('button[name=groups_close]').delay(900).queue(function(next){ $(this).click(); next(); });
                            notify(data.message, data.type, 9000);
                            reload_group_table();
                        }
                        init_edit_group_members_table();
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
        swal({
            title: "Are you sure?",
            text: "The selected Groups will be removed from your record",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            closeOnConfirm: false,
        }, function(){
            $.ajax({
                type: 'POST',
                url: base_url('groups/remove'),
                data: {'groups_ids[]': $('#group-table-command').bootgrid('getSelectedRows')},
                success: function (data) {
                    var data = $.parseJSON(data);
                    reload_group_table();
                    swal(data.title, data.message, data.type);
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
    $('.members-table-command').bootgrid('reload');
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
            iconDown: 'zmdi-caret-down',
            iconRefresh: 'zmdi-refresh',
            iconUp: 'zmdi-caret-up',
        },
        formatters: {
            commands: function (column, row) {
                return  '<button role="button" class="wave-effect btn btn-icon command-edit"    data-row-id="' + row.groups_id + '"><span class="zmdi zmdi-edit"></span></button> ' +
                        '<button type="button" class="wave-effect btn btn-icon command-delete"  data-row-id="' + row.groups_id + '"><span class="zmdi zmdi-delete"></span></button> ';
            },
        },

        ajax: true,
        ajaxSettings: {
            method: "POST",
            cache: false,
        },
        requestHandler: function (request)
        {
            // To accumulate custom parameter with the request object
            // console.log(request);
            return request;
        },
        url: base_url('groups/listing'),
        rowCount: [5, 10, 20, 30, 50, 100, -1],
        keepSelection: true,

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
        if( selectedGroupRowCount.length > 1 )
        {
            $('#delete-group-btn').addClass('show');
        } else {
            $('#delete-group-btn').removeClass('show');
        }

        var _selectedRows = groupTable.bootgrid('getSelectedRows');

        if( _selectedRows.length > 1 )
        {
            $('#delete-group-btn').addClass('show');
        }

    }).on("deselected.rs.jquery.bootgrid", function(e, rows)
    {
        selectedGroupRowCount.splice(-1, 1);

        // console.log(selectedGroupRowCount);
        if( selectedGroupRowCount.length > 1 )
        {
            $('#delete-group-btn').addClass('show');
        } else {
            $('#delete-group-btn').removeClass('show');
        }

        if( _selectedRows.length < 1 )
        {
            $('#delete-group-btn').removeClass('show');
        }

    }).on("loaded.rs.jquery.bootgrid", function (e) {
        /*
        | -----------------------------------------------------------
        | # Edit
        | -----------------------------------------------------------
        */
        groupTable.find(".command-edit").on("click", function () {
            var groups_id = $(this).parents('tr').data('row-id');
            $.ajax({
                type: 'POST',
                url: base_url('groups/edit/' + groups_id),
                data: {groups_id: groups_id},
                success: function (data) {
                    var group = $.parseJSON(data);
                    if( undefined !== group.type && group.type == 'error' ) {
                        swal(group.title, group.message, group.type);
                    } else {
                        $('#edit-group').modal("show");
                        var _form = $('#edit-group-form');


                        $.each(group, function (k, v) {
                            _form.find('[name=' + k + ']').val( v ).parent().addClass('fg-toggled');
                            $('select').trigger("chosen:updated");
                        });

                        $('#members-table-command-edit tr td.select-cell input:checked').trigger('click.rs.jquery.bootgrid');
                        init_edit_group_members_table();
                    }
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
                url  = base_url('groups/remove/') + '/' + id;
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: name + " will be trashed",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Remove",
                closeOnConfirm: false
            }, function(){
                // on deleting button
                $.ajax({
                    type: 'POST',
                    url: url,
                    success: function (data) {
                        var data = $.parseJSON(data);
                        reload_group_table();
                        swal(data.title, data.message, data.type);
                    }
                });
            });
        });
    });
    var _selectedRows = $('#group-table-command').bootgrid('getSelectedRows');
}

function init_add_group_table () {
    /*
    | ------------------------------------
    | # Add
    | ------------------------------------
    */
    $("#members-table-command-add").bootgrid({
        labels: {
            noResults: 'No Members found',
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
            // request.selectedRows = $('.members-table-command').bootgrid('getSelectedRows');
            // console.log('request');
            // console.log(request);
            return request;
        },
        responseHandler: function (response) {
            console.log(response);
            return response;
        },
        url: base_url('members/listing'),
        rowCount: [5, 10, 20, 30, 50, 100, -1],
        keepSelection: true,

        selection: true,
        multiSelect: true,
        caseSensitive: false,
    }).on("loaded.rs.jquery.bootgrid", function (e) {
        reload_dom();
    });
}

function init_edit_group_members_table()
{
    $("#members-table-command-edit").bootgrid("destroy");
    /*
    | ------------------------------------
    | # Edit
    | ------------------------------------
    */
    var membersEditTable = [];
    var membersTableCommandEdit = $("#members-table-command-edit").bootgrid({
        labels: {
            noResults: 'No Members found',
        },
        css: {
            icon: 'zmdi icon',
            iconColumns: 'zmdi-view-module',
            iconDown: 'zmdi-expand-more',
            iconRefresh: 'zmdi-refresh',
            iconUp: 'zmdi-expand-less',
        },
        formatters: {
            // commands: function (column, row) {
            //     // return  '<button type="button" data-toggle="tooltip" data-placement="top" title="Add to this Group" class="wave-effect btn btn-icon btn-xs command-add" data-row-id="' + row.members_id + '"><span class="zmdi zmdi-plus"></span></button> ' +
            //             // '<button type="button" data-toggle="tooltip" data-placement="top" title="Remove from this Group" class="wave-effect btn btn-icon btn-xs command-delete" data-row-id="' + row.members_id + '"><span class="zmdi zmdi-close"></span></button> ';
            // }
        },

        ajax: true,
        ajaxSettings: {
            method: "POST",
            cache: true,
        },
        requestHandler: function (request)
        {
            // To accumulate custom parameter with the request object
            return request;
        },
        responseHandler: function (response)
        {
            // To accumulate custom parameter with the response object
            // console.log("RESPONSE", response);
            membersEditTable = response.rows;
            return response;
        },
        url: base_url( 'members/listing' ),
        rowCount: [5, 10, 20, 30, 50, 100, -1],

        caseSensitive: false,
        multiSelect: true,
        keepSelection: true,
        selection: true,
    }).on("load.rs.jquery.bootgrid", function (e) {
        // $('#members-table-command-edit tr td.select-cell input:checked').trigger('click.rs.jquery.bootgrid');
    }).on("loaded.rs.jquery.bootgrid", function (e) {

        $('#members-table-command-edit tr td.select-cell input:checked').trigger('click.rs.jquery.bootgrid');
        var groups_id = $('#edit-group-form [name=groups_id]').val();
        var oldSelectedRows = membersTableCommandEdit.bootgrid('getSelectedRows');
        console.log("OSR: ", oldSelectedRows);
        reload_dom();
        for (var i = 0; i < membersEditTable.length; i++) {
            for (var j = 0; j < membersEditTable[i].groups_id.length; j++) {
                if( groups_id == membersEditTable[i].groups_id[j] ) {
                    $('#members-table-command-edit tr[data-row-id="'+membersEditTable[i].id+'"] td.select-cell input').trigger('click.rs.jquery.bootgrid');
                }
            };
        }

        /*
        | -----------------------------------------------------------
        | # Add To List
        | -----------------------------------------------------------
        */
        $("#members-table-command-edit").find(".command-add").on('click', function (e) {
            e.preventDefault();
            var id   = $(this).parents('tr').data('row-id'),
                name = $(this).parents('tr').find('td.members_name').text(),
                url  = base_url('members/update/' + id),
                value= $('#edit-group-form').find('[name=groups_id]').val();
            $(this).prop('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: url,
                data: { updating_groups: 'groups', value: value, action: 'add' },
                success: function (data) {
                    console.log(data);
                    var data = $.parseJSON(data);
                    reload_group_table();
                    if( 'error' == data.type )
                    {
                        swal('Error', data.message, data.type);
                    }
                    else
                    {
                        notify(data.message, data.type);
                    }
                },
                done: function (data) {
                    $(this).prop('disabled', '');
                }
            });
            return false;
        });

        /*
        | -----------------------------------------------------------
        | # Delete From List
        | -----------------------------------------------------------
        */
        $("#members-table-command-edit").find(".command-delete").on("click", function (e) {
            e.preventDefault();
            var id   = $(this).parents('tr').data('row-id'),
                name = $(this).parents('tr').find('td.members_name').text(),
                url  = base_url('members/update/' + id),
                value= $('#edit-group-form').find('[name=groups_id]').val();
            $(this).prop('disabled', 'disabled');
            $(this).attr('disabled', true);
            $.ajax({
                type: 'POST',
                url: url,
                data: { updating_groups: 'groups', value: value, action: 'remove' },
                success: function (data) {
                    var data = $.parseJSON(data);
                    console.log(data);
                    reload_group_table();
                    if( 'error' == data.type ) {
                        swal('Error', data.message, data.type);
                    } else {
                        notify(data.message, data.type);
                    }
                },
                done: function (data) {
                    console.log(data);
                    $(this).prop('disabled', '');
                    $(this).removeAttr('disabled');
                }
            });
        });
    });
}
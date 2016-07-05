jQuery(document).ready(function (e) {
    /*
    |-------------------------------
    | # Table Init
    |-------------------------------
    */
    init_modules_table();

    /*
    |------------------------------
    | # Add New Module
    |------------------------------
    */
    $('#add-new-module-btn').on('click', function (e) {
        $('#add-new-module-form')[0].reset();
        reload_selectpickers();
        $('#add-new-module-form [name=name]').focus();
    })
    var $moduleForm = $('#add-new-module-form').validate({
        rules: {
            name: 'required',
            slug: 'required',
        },
        messages: {
            name: {
                'required': "The Name field is required"
            },
            slug: {
                'required': "The slug field is required"
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
                            $('#add-new-module-form').find('input[name='+k+'], select[name='+k+']').parents('.form-group-validation').addClass('has-warning').append('<small class="help-block">'+v+'</small>');
                            // console.log(k,v);
                        });
                    }
                    else
                    {
                        notify(data.message, data.type, 9000);
                        $('#add-new-module-form')[0].reset();
                        $('#add-new-module-form [name=name]').focus();
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
    });
});

function reload_table() {
    jQuery('#modules-table').bootgrid('reload');
}
function init_modules_table() {
    var modulesTable = jQuery('#modules-table').bootgrid({
        labels: {
            loading: '<i class="zmdi zmdi-close zmdi-hc-spin"></i>',
            noResults: 'No Modules found',
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
                return  '<button role="button" class="wave-effect btn btn-icon command-edit"    data-row-id="' + row.types_id + '"><span class="zmdi zmdi-edit"></span></button> ' +
                        '<button type="button" class="wave-effect btn btn-icon command-delete"  data-row-id="' + row.types_id + '"><span class="zmdi zmdi-delete"></span></button> ';
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
        url: base_url('modules/listing'),
        rowCount: [5, 10, 20, 30, 50, 100, -1],
        keepSelection: true,

        selection: true,
        multiSelect: true,
        // rowSelect: true,
        caseSensitive: false,
    }).on("loaded.rs.jquery.bootgrid", function (e) {
        reload_dom();
        /*
        |---------------------------
        | # Edit a Module
        |---------------------------
        */
        modulesTable.find('.command-edit').on('click', function (e) {
            var id = $(this).parents('tr').data('row-id'),
                url = base_url('modules/edit/' + id);

            $.ajax({
                type: 'POST',
                url: url,
                data: {id: id},
                success: function (data) {
                    var module = $.parseJSON(data);
                    $('#edit-module').modal("show");
                    var _form = $('#edit-module-form');
                    _form[0].reset();
                    reload_selectpickers();
                    _form.find('[name=name]').focus();

                    $.each(module, function (k, v) {
                        _form.find('[name=' + k + ']').val( v ).parent().addClass('fg-toggled');
                    });
                }
            });
        });

        /*
        | -----------------------------------------------------------
        | # Delete
        | -----------------------------------------------------------
        */
        modulesTable.find(".command-delete").on("click", function (e) {
            var id   = $(this).parents('tr').data('row-id'),
                name = $(this).parents('tr').find('td.name').text(),
                url  = base_url('modules/remove/' + id);
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: name + " will be trashed.",
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
                        console.log(data);
                        reload_table();
                        swal("Removed", data.message, data.type);
                    }
                });
            });
        });

    });
}
$(document).on('ready', function() {
    window.Dropzone.options.dropzone = {
        acceptedFiles: '.csv',
        addRemoveLinks: true,
        init: function () {
            this.on("addedfile", function (file) {
                console.log('file added...');
            });

            this.on("success", function (file, response) {
                if( 'error' === response.type )
                {
                    swal('Error', response.message, response.type);
                    this.removeFile(file);
                }
                else
                {
                    var response = $.parseJSON(response);
                    notify(response.message, response.type, 2000);
                    this.removeFile(file);
                    // console.log(response);
                }
            });

        },
        error: function(file, response) {
            notify(response, 'danger', 0);
            this.removeFile(file);
        }
    };
});
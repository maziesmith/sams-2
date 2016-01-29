$(document).on('ready', function() {
    window.Dropzone.options.dropzone = {
        acceptedFiles: '.csv',
        addRemoveLinks: true,
        init: function () {
            this.on("addedfile", function (file) {
                console.log('file added...');
            });

            this.on("success", function (file, response) {
                var response = $.parseJSON(response);
                if( 'error' === response.type )
                {
                    swal('Error', $(response.message).text(), response.type);
                    this.removeFile(file);
                }
                else
                {
                    notify(response.message, response.type, 2000);
                    this.removeFile(file);
                    // console.log(response);
                }
            });

        },
        error: function(file, response) {
            var response = $.parseJSON(response);
            swal('Error', $(response.message).text(), response.type);
            this.removeFile(file);
        }
    };
});
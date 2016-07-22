jQuery(document).ready(function ($) {
    $('#generate-report').on('click', function (e) {
        e.preventDefault();

        var date_from = $("#date-from").val();
        var date_to = $("#date-to").val();
        var category = $("#category").val();
        var category_level = $("#category_level").val();

        if(date_from != "" && date_to != "" && category != "" && category_level != ""){
            document.location = base_url('monitor/generate?datefrom='+date_from+'&dateto='+date_to+'&category='+category+'&category_level='+category_level);
        }
    });

    $('#download-csv').on('click', function (e) {
        e.preventDefault();
        var date_from = $("#datefrom_val").text();
        var date_to = $("#dateto_val").text();
        var category = $("#category_val").text();
        var category_level = $("#category_level_val").text();
        document.location = "fetch_csv?datefrom="+date_from+"&dateto="+date_to+"&category="+category+"&category_level="+category_level+"";
    });

    $('#category').on('change', function (e) {
        e.preventDefault();

        if($(this).val()=="Contact"){

            $.ajax({
                url: 'fetch_contact',
                type: "GET",
                beforeSend: function () {                

                },
                complete:function(){
                },
                success: function (data) {
                    $('#category_level option').remove();
                    $.each(data, function(i, item) {
                        $('#category_level').append('<option value="'+item.id+'">'+item.firstname+' '+item.lastname+'</option>');
                    });
                    $('#category_level').trigger("chosen:updated");
                },

                error: function( jqXhr ) {
                    if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                        var json = $.parseJSON( jqXhr.responseText );
                    }
                }

            });
        } else  if($(this).val()=="Group"){
            $.ajax({
                url: 'fetch_group',
                type: "GET",
                beforeSend: function () {                

                },
                complete:function(){
                },
                success: function (data) {
                    $('#category_level option').remove();
                    $.each(data, function(i, item) {
                        $('#category_level').append('<option value="'+item.groupid+'">'+item.groupname+'</option>');
                    });
                    $('#category_level').trigger("chosen:updated");
                },

                error: function( jqXhr ) {
                    if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                        var json = $.parseJSON( jqXhr.responseText );
                    }
                }
            });            
        } else if ($(this).val()=="Level") {
            $.ajax({
                url: 'fetch_level',
                type: "GET",
                beforeSend: function () {                

                },
                complete:function(){
                },
                success: function (data) {
                    $('#category_level option').remove();
                    $.each(data, function(i, item) {
                        $('#category_level').append('<option value="'+item.levelid+'">'+item.levelname+'</option>');
                    });
                    $('#category_level').trigger("chosen:updated");
                },

                error: function( jqXhr ) {
                    if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                        var json = $.parseJSON( jqXhr.responseText );
                    }
                }
            });
        } else {
            $('#category_level option').remove();
            $('#category_level').trigger("chosen:updated");
        }
    });
})
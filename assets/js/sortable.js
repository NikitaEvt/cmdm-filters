// toastr initialize
toastr.options = {
    "closeButton": true,
    "debug": false,
    "positionClass": "toast-bottom-left",
    "onclick": null,
    "showDuration": "1000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
$( function() {
    function fixWidthHelper(e, ui) {
        ui.children().each(function() {
            $(this).width($(this).width());
        });
        return ui;
    }
    $( "table#sortable tbody" ).sortable( {
        helper: fixWidthHelper,
        // change: function( event, ui ){
        //     console.log('change function: ', ui);
        // },
        stop: function( event, ui ) {
            var element = [];
            $("table#sortable tbody tr").each(function(index) {
                var item = {
                    id: parseInt($(this).attr('id')),
                    sorder: $(this).index() + 1,
                    // parent_id: parent_id
                }
                element.push(item);

            });
            // send ajax for sorder
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: sortable_url,
                data: { element: element },
                success: function(response) {
                    console.log('Success: ', response);
                    if(response.success){
                        toastr["success"](response.message, "Статус");
                    } else {
                        toastr["error"](response.message, "Статус");
                    }
                }, 
                error: function(response){
                    toastr["error"](response.message, "Статус");
                }
            });
        }
    });


    // *************************************** foods items sortable *********************************************//
    $( "#food-items" ).sortable( {
        helper: fixWidthHelper,
        stop: function( event, ui ) {
            var element = [];
            $("#food-items div").each(function(index) {
                var item = {
                    id: parseInt($(this).attr('id')),
                    sorder: $(this).index() + 1,
                }
                element.push(item);
            });
            // send ajax for sorder
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: sortable_url,
                data: { element: element },
                success: function(response) {
                    console.log('Success: ', response);
                    if(response.success){
                        toastr["success"](response.message, "Статус");
                    } else {
                        toastr["error"](response.message, "Статус");
                    }
                }, 
                error: function(response){
                    toastr["error"](response.message, "Статус");
                }
            });
        }
    });
});
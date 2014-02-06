jQuery(function($){
    $( '.date_from' ).datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3,
        onClose: function( selectedDate ) {
            $( '.date_to' ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( '.date_to' ).datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3,
        onClose: function( selectedDate ) {
            $( '.date_from' ).datepicker( "option", "maxDate", selectedDate );
        }
    });

});
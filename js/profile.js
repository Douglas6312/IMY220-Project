$(document).ready(() =>{

    $("#profileDropdownLink").addClass("active activeLine");

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

});

$(document).ready(() =>{

    $("#exploreLink").addClass("active activeLine");

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

});


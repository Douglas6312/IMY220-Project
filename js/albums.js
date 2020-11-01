$(document).ready(() =>{

    $("#albumLink").addClass("active activeLine");

    $('#newAlbum_View').on('shown.bs.modal', function(){
        $('#myAlbums,.heading,#topHeader,#newFab,.pageContent,#infoMsg').addClass("blurBackground");
    }).on('hidden.bs.modal', function () {
        $('#myAlbums,.heading,#topHeader,#newFab,.pageContent,#infoMsg').removeClass("blurBackground");
    });

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

});

$(document).ready(() =>{

    $("#albumLink").addClass("active activeLine");

    $("#regPicture").on('change', function (e) {
        var file = $("input[type=file]").get(0).files[0];
        if(file)
        {
            var reader = new FileReader();
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            };
            reader.readAsDataURL(file);
        }
    });

    $('#newPost_View').on('shown.bs.modal', function(){
        $('.pageContent,.pageContent2,.heading,#topHeader,#newFab,#infoMsg').addClass("blurBackground");
    }).on('hidden.bs.modal', function () {
        $('.pageContent,.pageContent2,.heading,#topHeader,#newFab,#infoMsg').removeClass("blurBackground");
    });

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $(".goBack").on('click',function (e) {
        e.preventDefault();
        window.history.back();
    });

});

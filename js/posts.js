$(document).ready(() =>{

    $("#postLink").addClass("active activeLine");

    $(".middle").on('click',function () {
        window.location.href = "./post.php";
        //get data here and go to the actual post data....
    });

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
        $('#myFeed,#heading,#topHeader,#newFab').addClass("blurBackground");
    }).on('hidden.bs.modal', function () {
        $('#myFeed,#heading,#topHeader,#newFab').removeClass("blurBackground");
    });

});

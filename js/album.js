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

    $('#newPost_View,#editAlbum_View,#addFriend_View').on('shown.bs.modal', function(){
        $('.pageContent,.pageContent2,.heading,#topHeader,#newFab,#infoMsg').addClass("blurBackground");
    }).on('hidden.bs.modal', function () {
        $('.pageContent,.pageContent2,.heading,#topHeader,#newFab,#infoMsg').removeClass("blurBackground");
    });

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $(".goBack").on('click',function (e) {
        e.preventDefault();
        //window.history.back();
        window.location.href = "./albums.php";
    });

    $("#deleteAlbum").on('click',function (e) {
    $.confirm({
            animation:'zoom',
            columnClass: 'medium',
            escapeKey: true,
            backgroundDismiss: true,
            type: 'blue',
            typeAnimated: true,
            title: 'Delete Album',
            content: 'Are you sure you want to Delete this Album',
            buttons: {
                Delete: function () {
                    $.ajax({
                        url: './fragments/DBInterface.php',
                        type: 'POST',
                        data: {action: "deleteAlbum", albumID: $("#deleteAlbum").data('albumid') }
                    }).done(response => {
                        const json = JSON.parse(response);
                        if (json.msg === "Valid")
                        {
                            $(this).html('Remove <i class="fa fa-times fa-2x" aria-hidden="true"></i>');
                            window.location.href = "./albums.php";
                        }
                        else
                        {
                            $.alert({
                                animation:'zoom',
                                columnClass: 'medium',
                                escapeKey: true,
                                backgroundDismiss: true,
                                type: 'blue',
                                typeAnimated: true,
                                title: 'Alert!',
                                content: 'An Error occurred, user was not added as a participant to this album',
                            });
                        }
                    });
                },
                cancel: function () {

                }
            }
        });
    });

    $('.friendFunc').on('click', function (e) {
        if ($(this).hasClass('addParticipant'))
        {
            $.ajax({
                url: './fragments/DBInterface.php',
                type: 'POST',
                data: {action: 'addParticipant', albumID: $(this).data('albumid'), userID: $(this).data('userid')}
            }).done(response => {
                const json = JSON.parse(response);
                if (json.msg === "Valid")
                {
                    $(this).removeClass('addParticipant').addClass('removeParticipant');
                    $(this).html('Remove <i class="fa fa-times fa-2x" aria-hidden="true"></i>');
                }
                else
                {
                    $.alert({
                        animation:'zoom',
                        columnClass: 'medium',
                        escapeKey: true,
                        backgroundDismiss: true,
                        type: 'blue',
                        typeAnimated: true,
                        title: 'Alert!',
                        content: 'An Error occurred, user was not added as a participant to this album',
                    });
                }
            });
        }
        else if($(this).hasClass('removeParticipant'))
        {
            $.ajax({
                url: './fragments/DBInterface.php',
                type: 'POST',
                data: {action: 'removeParticipant', albumID: $(this).data('albumid'), userID: $(this).data('userid')}
            }).done(response => {
                const json = JSON.parse(response);
                if (json.msg === "Valid")
                {
                    $(this).removeClass('removeParticipant').addClass('addParticipant');
                    $(this).html('Add <i class="fa fa-check fa-2x" aria-hidden="true"></i>');
                }
                else
                {
                    $.alert({
                        animation:'zoom',
                        columnClass: 'medium',
                        escapeKey: true,
                        backgroundDismiss: true,
                        type: 'blue',
                        typeAnimated: true,
                        title: 'Alert!',
                        content: 'An Error occurred, could not remove participant from the Album',
                    });
                }
            });
        }
    });



});

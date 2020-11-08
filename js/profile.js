$(document).ready(() =>{

    $("#profileDropdownLink").addClass("active activeLine");

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $('#addProfilePhoto_View,#editProfile_View').on('shown.bs.modal', function(){
        $('.pageContent,.pageContent2,.heading,#topHeader,#newFab,#infoMsg').addClass("blurBackground");
    }).on('hidden.bs.modal', function () {
        $('.pageContent,.pageContent2,.heading,#topHeader,#newFab,#infoMsg').removeClass("blurBackground");
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

    $('img').off('click');

    $("#deleteUser").on('click',function (e) {
        e.preventDefault();
        $.confirm({
            animation:'zoom',
            columnClass: 'medium',
            escapeKey: true,
            backgroundDismiss: true,
            type: 'blue',
            typeAnimated: true,
            title: 'Delete Account',
            content: 'Are you sure you want to permanently Delete this user Account ?',
            buttons: {
                Delete: function () {
                    $.ajax({
                        url: './fragments/DBInterface.php',
                        type: 'POST',
                        data: {action: "deleteUser", userID: $("#deleteUser").data('userid') }
                    }).done(response => {
                        const json = JSON.parse(response);
                        if (json.msg === "Valid")
                        {
                            window.location.href = "../index.php";
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
                                content: 'An Error occurred, User Account was not Deleted',
                            });
                        }
                    });
                },
                cancel: function () {

                }
            }
        });
    });

    $(document).on('click','.followBTN', function (e) {
        e.preventDefault();
        let action = $(this).data('action');
        let elem = $(this);
        $.ajax({
            url: './fragments/DBInterface.php',
            type: 'POST',
            data: {action: action, follower: $(this).data('follower'), following: $(this).data('following')}
        }).done(response => {
            const json = JSON.parse(response);
            if (json.msg === "Valid")
            {
                if (action == "unfollow")
                {
                    $(elem).html("Follow").removeClass('followBTNUnfollow').addClass('followBTNFollow').data('action','folllow');
                }
                else
                {
                    $(elem).html("Unfollow").removeClass('followBTNFollow').addClass('followBTNUnfollow').data('action','unfollow');
                }
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
                    content: 'An Error occurred, Please try again later !',
                });
            }
        });
    });

});

$(document).ready(() =>{

    $("#postLink").addClass("active activeLine");

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $(".goBack").on('click',function (e) {
        e.preventDefault();
        window.history.back(); //this goes back to the previous window where the user was coming from...
        //window.location.href = "./albums.php";
    });

    $('#editPost_View').on('shown.bs.modal', function(){
        $('.pageContent,.pageContent2,.heading,#topHeader,#newFab,#infoMsg').addClass("blurBackground");
    }).on('hidden.bs.modal', function () {
        $('.pageContent,.pageContent2,.heading,#topHeader,#newFab,#infoMsg').removeClass("blurBackground");
    });

    $("#deleteImage").on('click',function (e) {
        $.confirm({
            animation:'zoom',
            columnClass: 'medium',
            escapeKey: true,
            backgroundDismiss: true,
            type: 'blue',
            typeAnimated: true,
            title: 'Delete Post',
            content: 'Are you sure you want to permanently Delete this Post',
            buttons: {
                Delete: function () {
                    $.ajax({
                        url: './fragments/DBInterface.php',
                        type: 'POST',
                        data: {action: "deleteImage", imageID: $("#deleteImage").data('imageid') }
                    }).done(response => {
                        const json = JSON.parse(response);
                        if (json.msg === "Valid")
                        {
                            window.location.href = "./posts.php";
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
                                content: 'An Error occurred, Post was not Deleted',
                            });
                        }
                    });
                },
                cancel: function () {

                }
            }
        });
    });

    $('.addComment').on('click', function (e) {
        $.confirm({
            title: 'New Comment',
            columnClass: 'medium',
            escapeKey: true,
            backgroundDismiss: true,
            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<input type="text" placeholder="Enter Comment here..." class="comment form-control mt-4" required />' +
                '</div>' +
                '</form>',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var comment = this.$content.find('.comment').val();
                        if(!comment){
                            $.alert('Comment can\'t be empty');
                            return false;
                        }
                        $.ajax({
                            url: './fragments/DBInterface.php',
                            type: 'POST',
                            data: {action: "addComment", comment: comment,  imageID: $(".addComment").data('imageid') }
                        }).done(response => {
                            const json = JSON.parse(response);
                            if (json.msg === "Valid")
                            {
                                //window.location.href = "./posts.php";
                                $('.comments').append('<div class="media mb-2">\n' +
                                                '     <a href="./profile.php?userID='+json.userID+'" class="text-dark"><img class="mr-3 rounded-circle" alt="avatar" src="'+json.profileImage+'" /></a>\n' +
                                                '     <div class="media-body">\n' +
                                                '         <div class="row">\n' +
                                                '             <div class="col-8 d-flex">\n' +
                                                '                 <h5><a href="./profile.php?userID='+json.userID+'" class="text-dark">'+json.userName+'</a></h5>\n' +
                                                '             </div>\n' +
                                                '         </div> '+json.comment +
                                                '     </div>\n' +
                                                ' </div>');
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
                                    content: 'An Error occurred, Post was not Deleted',
                                });
                            }
                        });
                    }
                },
                cancel: function () {
                    //close
                },
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    });

    $('.reportPost').on('click', function (e) {
        e.preventDefault();
        let imageID = $(this).data('imageid');
        let reasonID = $(this).data('reasonid');
        $.confirm({
            animation:'zoom',
            columnClass: 'medium',
            escapeKey: true,
            backgroundDismiss: true,
            type: 'blue',
            typeAnimated: true,
            title: 'Report Post',
            content: 'Are you sure you want to Report this Post',
            buttons: {
                Report: function () {
                    $.ajax({
                        url: './fragments/DBInterface.php',
                        type: 'POST',
                        data: {action: "reportPost", imageID: imageID, reasonID: reasonID}
                    }).done(response => {
                        const json = JSON.parse(response);
                        if (json.msg === "Valid")
                        {
                            $('.reportDropdown').remove();
                            $('#reportPostBtn').append('<span class="btn btn-danger col-1 m-1 text-white float-right">' +
                                '<i class="fa fa-exclamation" aria-hidden="true"></i> Reported</span>');
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
                                content: 'An Error occurred, Post was not Reported',
                            });
                        }
                    });
                },
                cancel: function () {

                }
            }
        });
    });

});
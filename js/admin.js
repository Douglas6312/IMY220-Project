$(document).ready(() =>{

    $("#profileDropdownLink").addClass("active activeLine");

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $(".resetPost").on('click',function (e) {
        e.preventDefault();
        let imageID = $(this).data('imageid');
        $.confirm({
            animation:'zoom',
            columnClass: 'medium',
            escapeKey: true,
            backgroundDismiss: true,
            type: 'blue',
            typeAnimated: true,
            title: 'Reset Post',
            content: 'Are you sure you want to reset/ un-report this post',
            buttons: {
                Reset: function () {
                    $.ajax({
                        url: './fragments/DBInterface.php',
                        type: 'POST',
                        data: {action: "resetPost", imageID: imageID }
                    }).done(response => {
                        const json = JSON.parse(response);
                        if (json.msg === "Valid")
                        {
                            $("#image"+imageID).remove();
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
                                content: 'An Error occurred, Post was not reset/ un-reported',
                            });
                        }
                    });
                },
                cancel: function () {

                }
            }
        });
    });

    $(".deletePost").on('click',function (e) {
        e.preventDefault();
        let imageID = $(this).data('imageid');
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
                        data: {action: "deleteImage", imageID: imageID }
                    }).done(response => {
                        const json = JSON.parse(response);
                        if (json.msg === "Valid")
                        {
                            $("#image"+imageID).remove();
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

    $(document).on('click','.deleteReportReason',function (e) {
        e.preventDefault();
        let reasonID = $(this).data('reasonid');
        $.confirm({
            animation:'zoom',
            columnClass: 'medium',
            escapeKey: true,
            backgroundDismiss: true,
            type: 'blue',
            typeAnimated: true,
            title: 'Delete Report Reason',
            content: 'Are you sure you want to permanently Delete this Report Reason',
            buttons: {
                Delete: function () {
                    $.ajax({
                        url: './fragments/DBInterface.php',
                        type: 'POST',
                        data: {action: "deleteReportReason", reasonID: reasonID }
                    }).done(response => {
                        const json = JSON.parse(response);
                        if (json.msg === "Valid")
                        {
                            $("#reason"+reasonID).remove();
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
                                content: 'An Error occurred, Report Reason was not Deleted',
                            });
                        }
                    });
                },
                cancel: function () {

                }
            }
        });
    });

    $(document).on('click', '.addReportReason' ,function (e) {
        e.preventDefault();
        $.confirm({
            title: 'New Report Reason',
            columnClass: 'medium',
            escapeKey: true,
            backgroundDismiss: true,
            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<input type="text" placeholder="Enter Reason here..." class="reason form-control mt-4" required />' +
                '</div>' +
                '</form>',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var reason = this.$content.find('.reason').val();
                        if(!reason){
                            $.alert('Reason can\'t be empty');
                            return false;
                        }
                        $.ajax({
                            url: './fragments/DBInterface.php',
                            type: 'POST',
                            data: {action: "addReportReason", reason: reason}
                        }).done(response => {
                            const json = JSON.parse(response);
                            if (json.msg === "Valid")
                            {
                                $('.reasonTBL').append('<tr id="reason'+json.reasonID+'">\n' +
                                    '                         <td class="align-middle">'+reason+'</td>\n' +
                                    '                         <td><a class="btn btn-danger btn-sm col-12 text-white deleteReportReason" data-reasonid="'+json.reasonID+'"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</a></td>\n' +
                                    '                   </tr>');
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

    $(document).on('click','.removeAdminUser',function (e) {
        e.preventDefault();
        let adminID = $(this).data('adminid');
        $.confirm({
            animation:'zoom',
            columnClass: 'medium',
            escapeKey: true,
            backgroundDismiss: true,
            type: 'blue',
            typeAnimated: true,
            title: 'Remove Admin User',
            content: 'Are you sure you want to Remove this user as an Admin',
            buttons: {
                Remove: function () {
                    $.ajax({
                        url: './fragments/DBInterface.php',
                        type: 'POST',
                        data: {action: "deleteAdminUser", adminID: adminID }
                    }).done(response => {
                        const json = JSON.parse(response);
                        if (json.msg === "Valid")
                        {
                            $("#admin"+adminID).remove();
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
                                content: 'An Error occurred, Admin user was not removed',
                            });
                        }
                    });
                },
                cancel: function () {

                }
            }
        });
    });

    $(document).on('click', '.addAdminUser' ,function (e) {
        e.preventDefault();
        $.confirm({
            title: 'Admin User as Admin',
            columnClass: 'medium',
            escapeKey: true,
            backgroundDismiss: true,
            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<input type="email" placeholder="Enter Admin Email Address..." class="adminEmail form-control mt-4" required />' +
                '</div>' +
                '</form>',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var adminEmail = this.$content.find('.adminEmail').val();
                        if(!adminEmail){
                            $.alert('Admin Email can\'t be empty');
                            return false;
                        }
                        $.ajax({
                            url: './fragments/DBInterface.php',
                            type: 'POST',
                            data: {action: "newAdminUser", adminEmail: adminEmail}
                        }).done(response => {
                            const json = JSON.parse(response);
                            if (json.msg === "Valid")
                            {
                                $('.adminTBL').append('<tr id="admin'+json.adminID+'">\n' +
                                    '                         <td class="align-middle">'+adminEmail+'</td>\n' +
                                    '                         <td><a class="btn btn-danger btn-sm col-12 text-white removeAdminUser" data-adminid="'+json.adminID+'"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</a></td>\n' +
                                    '                   </tr>');
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
                                    content: json.msg,
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

});

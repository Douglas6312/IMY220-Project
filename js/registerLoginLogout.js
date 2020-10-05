$(document).ready(() =>{

    $('button#loginBtn').on('click',function (event) {
        event.preventDefault();

        $('#loginWarning').remove();
        $('input').removeClass('inputWarning');
        const email = $('#loginEmail').val();
        const pass = $('#loginPass').val();

        $.ajax({
            url: './php/checkCredentials.php',
            type: 'POST',
            data: {email: email, pass: pass},
            beforeSend:function () {
                $('#loginBtn i').toggle();
                $('#loginBtn').prop("disabled",true)
                    .append('<i class="fa fa-hourglass" id="hourGlass" aria-hidden="true"></i>');
            }
        }).done(response => {

            const json = JSON.parse(response);

            if (json.msg === "Valid")
            {
                localStorage.setItem("userDetails",JSON.stringify(json));
                window.location.href="./php/home.php";
            }
            else
            {
                $("#loginWarning").remove();

                $('<div></div>',{
                    html:json.msg,
                    class:"alert alert-warning",
                    id:"loginWarning"
                }).insertAfter($('form'));

                $('input').toggleClass('inputWarning');
            }
        }).always(() => {
            $('#loginBtn').prop("disabled",false);
            $('#loginBtn i').toggle();
            $('button #hourGlass').remove();
        })
    });

    $('button#registerBtn').on('click',function (event) {
        event.preventDefault();

        $('#loginWarning').remove();
        $('#pass1').removeClass('inputWarning');
        $('#pass2').removeClass('inputWarning');

        const name = $('#regName').val();
        const bio = $('#regBio').val();
        const email = $('#regEmail').val();
        const dob = $('#regBirthDate').val();
        const pass1 = $('#pass1').val();
        const pass2 = $('#pass2').val();

        //TODO sanitise user input here before enter it into the DB
        //TODO hash passwords
        //TODO name,email validation !!!
        //TODO how to disable the hover of btn when loading the with hourglass

        if (pass1 === pass2)
        {
            $.ajax({
                url: './php/checkCredentials.php',
                type: 'POST',
                data: {name: name, bio: bio,email: email, dob: dob, pass1: pass1, pass2: pass2},
                beforeSend:function () {
                    $('#registerBtn i').toggle();
                    $('#registerBtn').prop("disabled",true)
                        .append('<i class="fa fa-hourglass" id="hourGlass" aria-hidden="true"></i>');
                }
            }).done(response => {

                const json = JSON.parse(response);

                if (json.msg === "Valid")
                {
                    localStorage.setItem("userDetails",JSON.stringify(json));
                    window.location.href="./php/home.php";
                }
                else
                {
                    $("#loginWarning").remove();

                    $('<div></div>',{
                        html:json.msg,
                        class:"alert alert-warning mt-4",
                        id:"loginWarning"
                    }).insertAfter($('form'));
                }
            }).always(() => {
                $('#registerBtn').prop("disabled",false);
                $('#registerBtn i').toggle();
                $('button #hourGlass').remove();
            });
        }
        else
        {
            $("#loginWarning").remove();

            $('<div></div>',{
                html:"Passwords dont match !!!",
                class:"alert alert-warning",
                id:"loginWarning"
            }).insertAfter($('form'));

            $('#pass1').toggleClass('inputWarning');
            $('#pass2').toggleClass('inputWarning');
        }
    });

    //TODO add event listener hear for when user logs out to delete all cookies and that them back to the splash screen...

});
$(document).ready(() =>{

    $('button#loginBtn').on('click',function (event) {
        event.preventDefault();

        $('#loginWarning').remove();
        $('input').removeClass('inputWarning');
        const email = $('#loginEmail').val();
        const pass = $('#loginPass').val();

        if (email.length != 0 && pass.length != 0)
        {
            $.ajax({
                url: './php/fragments/checkCredentials.php',
                type: 'POST',
                data: {logEmail: email, logPass: pass},
                beforeSend:function () {
                    $('#loginBtn i').removeClass("fa fa-angle-right");
                    $('#loginBtn i').addClass("fa fa-hourglass");
                    $('#loginBtn').attr("disabled",true);
                }
            }).done(response => {
                console.log(response);
                const json = JSON.parse(response);


                if (json.msg === "Valid")
                {
                    //localStorage.setItem("userDetails",JSON.stringify(json));
                    console.log("yaaaayyyy");
                    window.location.href="./php/myFeed.php";
                }
                else
                {
                    $("#loginWarning").remove();

                    $('<div></div>',{
                        html:`<b>${json.msg}</b>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>`,
                        class:"alert alert-warning alert-dismissible fade show",
                        id:"loginWarning",
                        role: "alert"
                    }).insertAfter($('#loginForm'));

                    $('input').toggleClass('inputWarning');
                }
            }).always(() => {
                $('#loginBtn i').removeClass("fa fa-hourglass");
                $('#loginBtn i').addClass("fa fa-angle-right");
                $('#loginBtn').attr("disabled",false);
                $("#splash").addClass("blurBackground");
            })
        }
    });

    $('button#registerBtn').on('click',function (event) {
        event.preventDefault();

        let regExCheck = true;
        $('#loginWarning').remove();
        $("#nameWarning").remove();
        $("#emailWarning").remove();
        $("#passwordWarning").remove();
        $('#pass1').removeClass('inputWarning');
        $('#pass2').removeClass('inputWarning');
        $('#regName').removeClass('inputWarning');
        $('#regEmail').removeClass('inputWarning');

        const name = $('#regName').val();
        const bio = $('#regBio').val();
        const email = $('#regEmail').val();
        const dob = $('#regBirthDate').val();
        const pass1 = $('#pass1').val();
        const pass2 = $('#pass2').val();

        var regexEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var regexName = /^[0-9a-zA-Z]+$/;// /^[a-zA-Z][a-zA-Z ]+[a-zA-Z]$/; // allows only letters and spaces between words, NONE before and after
        var regexPassword = /^(?=.*[!@#$%^&*()\-_=+`~\[\]{}?|])(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,30}$/;

        if ( name.length === 0 || !regexName.test(name))
        {
            $("#nameWarning").remove();

            $('<div></div>',{
                html:`<b>Invalid Name: </b>ONLY Letters and numbers
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                 </button>`,
                class:"alert alert-warning alert-dismissible fade show",
                id:"nameWarning",
                role: "alert"
            }).insertAfter($('#registerForm'));

            $('#regName').toggleClass('inputWarning');

            regExCheck = false;
        }

        if ( email.length === 0 || !regexEmail.test(email))
        {
            $("#emailWarning").remove();

            $('<div></div>',{
                html:`<b>Invalid Email</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                 </button>`,
                class:"alert alert-warning alert-dismissible fade show",
                id:"emailWarning",
                role: "alert"
            }).insertAfter($('#registerForm'));

            $('#regEmail').toggleClass('inputWarning');

            regExCheck = false;
        }

        if ( (pass1.length === 0 || !regexPassword.test(pass1)) || (pass2.length === 0 || !regexPassword.test(pass2)) )
        {
            $("#passwordWarning").remove();

            $('<div></div>',{
                html:`<b>Invalid Password:</b> Make sure to follow good password conventions (capital, lowercase, special characters,numbers and min length of 8)
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                 </button>`,
                class:"alert alert-warning alert-dismissible fade show",
                id:"passwordWarning",
                role: "alert"
            }).insertAfter($('#registerForm'));

            $('#pass1').toggleClass('inputWarning');
            $('#pass2').toggleClass('inputWarning');

            regExCheck = false;
        }

        if (pass1 !== pass2)
        {
            $("#loginWarning").remove();

            $('<div></div>',{
                html:`<b>Passwords dont match !!!<b/>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                 </button>`,
                class:"alert alert-warning alert-dismissible fade show",
                id:"loginWarning",
                role: "alert"
            }).insertAfter($('#registerForm'));

            $('#pass1').removeClass('inputWarning');
            $('#pass2').removeClass('inputWarning');
            $('#pass1').toggleClass('inputWarning');
            $('#pass2').toggleClass('inputWarning');

            regExCheck = false;
        }

        if (regExCheck)
        {
            $.ajax({
                url: './php/fragments/checkCredentials.php',
                type: 'POST',
                data: {regName: name, regBio: bio,regEmail: email, regDob: dob, regPass1: pass1},
                beforeSend:function () {
                    $('#registerBtn i').removeClass("fa fa-angle-right");
                    $('#registerBtn i').addClass("fa fa-hourglass");
                    $('#registerBtn').attr("disabled",true);
                }
            }).done(response => {

                console.log(response);

                const json = JSON.parse(response);

                if (json.msg === "Valid")
                {
                    //localStorage.setItem("userDetails",JSON.stringify(json));
                    window.location.href="./php/myFeed.php";
                }
                else
                {
                    $("#loginWarning").remove();

                    $('<div></div>',{
                        html:`<b>${json.msg}</b>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>`,
                        class:"alert alert-warning mt-4 alert-dismissible fade show",
                        id:"loginWarning",
                        role: "alert"
                    }).insertAfter($('#registerForm'));
                }
            }).always(() => {
                $('#registerBtn i').removeClass("fa fa-hourglass");
                $('#registerBtn i').addClass("fa fa-angle-right");
                $('#registerBtn').attr("disabled",false);
            });
        }
    });

    $('#login_view').on('shown.bs.modal', function(){
        $('#splash').addClass("blurBackground");
    }).on('hidden.bs.modal', function () {
        $('#splash').removeClass("blurBackground");
    });

    $('#register_view').on('shown.bs.modal', function(){
        $('#splash').addClass("blurBackground");
    }).on('hidden.bs.modal', function () {
        $('#splash').removeClass("blurBackground");
    });

});
$(document).ready(() =>{

    $("#goBack").on('click',function (e) {
        e.preventDefault();
        window.history.back(); //this goes back to the previous window where the user was coming from...
    });

});
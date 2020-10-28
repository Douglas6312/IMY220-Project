$(document).ready(() =>{

    // $("#postLink").addClass("active activeLine"); set the active class depending on where the person came from...

    $("#goBack").on('click',function (e) {
        e.preventDefault();
        window.history.back(); //this goes back to the previous window where the user was coming from...
    });

});
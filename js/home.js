$(document).ready(() =>{

    //TODO asynchronously load the post for the user
    //TODO create a infinite scroll that keeps loading new content
    //TODO show a loading symbol while the data is being fetched
    //TODO make sure to display in reverse chronological order
    //TODO add relevant event listens for when user wants to view the post or the user profile who posted it
    //TODO make sure to make correct use of the data attribute in html to store the relevant ID's
    //TODO when adding new images alternate between the diff coulombs

    $("#likePhoto").on('click',function (e) {
        e.preventDefault();
        if ($(this).find('span').data('hasstared') === false)
        {
            $(this).find('i').removeClass("fa fa-star-o").addClass("fa fa-star").css("color","yellow");
            let count = parseInt($(this).find('span').text());
            $(this).find('span').text(count+1);
            $(this).find('span').data('hasstared', true);
            //ajax function here to update DB!!!!
        }
        else
        {
            $(this).find('i').removeClass("fa fa-star").addClass("fa fa-star-o").css("color","");
            let count = parseInt($(this).find('span').text());
            $(this).find('span').text(count-1);
            $(this).find('span').data('hasstared', false);
            //ajax function here to update DB!!!!
        }
    });

    $(".middle").on('click',function () {
        window.location.href = "./post.php";
        //get data here and go to the actual post data....
    });


    $('#newPost_View').on('shown.bs.modal', function(){
        $('#myFeed,#heading,#topHeader').addClass("blurBackground");
    }).on('hidden.bs.modal', function () {
        $('#myFeed,#heading,#topHeader').removeClass("blurBackground");
    });

});

$(document).ready(() =>{

    $(".likePhoto").on('click',function (e) {
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

    $("img,.middle").on('click',function () {
        let imageID = $(this).parent().data("imageid");
        window.location.href = "./post.php?imageID="+imageID;
    });

});

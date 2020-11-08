$(document).ready(() =>{

    $("#messagesLink").addClass("active activeLine");

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $('html, body').animate({scrollTop:$(document).height()}, 'slow');

    $('.viewFriendMessages').on('click', function (e) {
        e.preventDefault();
        $('#userMessages').empty();
        $('#userMessages').append('<a href="./profile.php?userID=" data-userid="123">\n' +
            '                <div class="col-12 mb-2">\n' +
            '                    <div class="card">\n' +
            '                        <div class="row">\n' +
            '                            <div class="card-header col-12">\n' +
            '                                <div class="row">\n' +
            '                                    <div class="col-10 float-left align-self-center text-dark"><h3>John</h3></div>\n' +
            '                                    <div class="col-2"><img class="float-right profileFriends" src="../gallery/profilePics/default.png" height="50"></div>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </a>');

        $('#userMessages').append('<div class="msg border border-secondary">\n' +
            '                <ul id="messages">\n' +
            '                    <li class="sender"><small><b>Douglas</b></small><p>Hey your new Photo is amazing</p></li>\n' +
            '                    <li class="receiver"><small><b>John</b></small><p>Yeah thanks man, it was really challenge</p></li>\n' +
            '                    <li class="sender"><small><b>Douglas</b></small><p>How come ?</p></li>\n' +
            '                    <li class="receiver"><small><b>John</b></small><p>Well, the clouds kept covering the mountain peek</p></li>\n' +
            '                    <li class="sender"><small><b>Douglas</b></small><p>Oh wow, so how long did you have to wait ?</p></li>\n' +
            '                    <li class="receiver"><small><b>John</b></small><p>Almost 4 hours before i got a clear shot</p></li>\n' +
            '                    <li class="sender"><small><b>Douglas</b></small><p>Damn, well you persistence paid off</p></li>\n' +
            '                    <li class="receiver"><small><b>John</b></small><p>Yeah i believe so too</p></li>\n' +
            '                    <li class="sender"><small><b>Douglas</b></small><p>Whats your next project</p></li>\n' +
            '                    <li class="receiver"><small><b>John</b></small><p>I have a wedding shoot coming up soon</p></li>\n' +
            '                    <li class="sender"><small><b>Douglas</b></small><p>Oh nice, ive just finished one. It was really fun</p></li>\n' +
            '                    <li class="receiver"><small><b>John</b></small><p>Yeah i cant wait for it !</p></li>\n' +
            '                </ul>\n' +
            '            </div>');
        $('.msg').scrollTop($('.msg')[0].scrollHeight);

    });

    $('#friend1').click();

    $('#msgSendBtn').on("click", function (e) {
        e.preventDefault();
        $('#messages').append('<li class="sender"><small><b>Douglas</b></small><p>'+$('#messageInput').val()+'</p></li>');
        $('#messageInput').val('');
        $('.msg').scrollTop($('.msg')[0].scrollHeight);
    })


});

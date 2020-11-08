<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Messages</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php"; ?>
    <link rel="stylesheet" type="text/css" href="../css/messages.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php"; ?>

<div  class="heading">
    <h1>My Messages</h1>
</div>

<div  class="headingFriends mt-3 col-4">
    <h2>My Friends</h2>
</div>
<div class="pageContent">
    <div class="row">
        <div class="col-5 msgFriends">
            <?php

            $friendsQuery = "SELECT *
                    FROM tbuser u
                    INNER JOIN tbfollower f1 ON f1.userIDFollowing = u.userID
                    INNER JOIN tbfollower f2 ON f1.userIDFollowing = f2.userIDFollower
                    WHERE f1.userIDFollower = ".$_SESSION['userID'];

            $res = $mysqli->query($friendsQuery);
            if ($res && $res->num_rows > 0)
            {
                $count = 1;
                while($row = $res->fetch_assoc())
                {
                    echo '<a id="friend'.$count++.'" class="viewFriendMessages" data-friendid="'.$row['userID'].'" href=""><div class="col-12 mb-2">
                            <div class="card">
                                <div class="row">
                                    <div class="card-header col-12">
                                        <div class="row">
                                            <div class="col-10 float-left align-self-center text-dark"><strong>'.$row['name'];
                                                    $query = "SELECT * FROM tbmessage WHERE senderUserID = ".$row['userID']." AND  receiverUserID = ".$_SESSION['userID']." AND hasRead = false";
                                                    $res = $mysqli->query($query);
                                                    if ($res && $res->num_rows > 0)
                                                    {
                                                        echo '<span class="fa-stack float-right">
                                                        <span class="fa fa-bell fa-stack-2x"></span>
                                                        <strong class="fa-stack-1x text-white">'.$res->num_rows.'</strong>';
                                                    }
                                                   echo'</span>
                                                    </strong>
                                                </div>
                                                <div class="col-2"><img class="float-right profileFriends" src="'.$row['profileImage'].'" height="50"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>';

                }
            }
            ?>
        </div>

        <div class="col-1 vl"></div>

        <div class="col-6" id="userMessages"></div>

        <div class="mb-4 mt-2 col-6 offset-6 sendMSG">
            <form action="">
                <div class="input-group">
                    <label for="messageInput" class="sr-only">messageInput</label>
                    <input type="text" id="messageInput" class="form-control" placeholder="Type Your Message here..." autocomplete="off">
                    <span class="input-group-btn ml-1">
                            <button class="btn btn-secondary" id="msgSendBtn" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </span>
                </div>
            </form>
        </div>

    </div>
</div>


<!--<main class="pageContent">
    <div class="row">
        <div class="bg-text">
            <h1>COMING SOON</h1>
            <p>This feature is under construction</p>
        </div>
    </div>
</main>-->

    <?php include "./fragments/jsLibraries.php"; ?>
    <script src="../js/messages.js"></script>
</body>
</html>

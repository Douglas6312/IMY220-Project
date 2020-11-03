<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Albums</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php"; ?>
    <link rel="stylesheet" type="text/css" href="../css/album.css" />
    <link rel="stylesheet" type="text/css" href="../css/postsFragment.css" />
    <link rel="stylesheet" type="text/css" href="../css/posts.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php"; ?>


<?php

$editAlbumTitle = '';
$editAlbumDescription = '';
$editAlbumHashTags = '';
$editAlbumPrivacy = '';

$albumInfoQuery = "SELECT *
                    FROM tbalbum
                    WHERE albumID = ".$_GET['albumID'].";";

    $res = $mysqli->query($albumInfoQuery);
    if ($res && $res->num_rows > 0)
    {
        while($row = $res->fetch_assoc())
        {
            $editAlbumTitle = $row['title'];
            $editAlbumDescription = $row['description'];
            $editAlbumPrivacy = $row['privacy'];

            echo '<div class="heading">
            <h1>
            <a href="#" class="goBack"><i class="fa fa-arrow-left text-secondary" aria-hidden="true"></i></a> 
             '.$row['title'].'&nbsp;';
            $getUserQuery = "SELECT *
                            FROM tbalbumparticipant
                            WHERE albumID = ".$_GET['albumID'].";";
            $result = $mysqli->query($getUserQuery);
            if ($result && $result->num_rows > 0)
            {
                echo '<i class="fa fa-users privacyIcon" aria-hidden="true"></i>';
            }
            else
            {
                if ($row["privacy"] == "private")
                    echo '<i class="fa fa-lock privacyIcon" aria-hidden="true"></i>';
                else
                    echo '<i class="fa fa-unlock privacyIcon" aria-hidden="true"></i>';
            }
            echo '<span class="float-right">';
            $getUserQuery = "SELECT *
                            FROM tbuser
                            WHERE userID = ".$row['userID'].";";
            $result = $mysqli->query($getUserQuery);
            if ($result && $result->num_rows > 0)
            {
                while($rowResult = $result->fetch_assoc())
                {
                    echo '<a href="./profile.php?userID='.$rowResult["userID"].'" class="text-secondary">'.$rowResult["name"].'</a>';
                }
            }
          echo '</span>
            </h1>
           </div>
           <h3 class="pageContent2">'.$row['description'].'&nbsp;&nbsp;';
            $getHashtagsQuery = "SELECT *
                            FROM tbalbumhashtag
                            WHERE albumID = ".$_GET['albumID'].";";
            $result = $mysqli->query($getHashtagsQuery);
            if ($result && $result->num_rows > 0)
            {
                while($rowResult = $result->fetch_assoc())
                {
                    $editAlbumHashTags .= $rowResult['hashtag'].' ';
                    echo '<a href="./explore.php?hashtag='.substr($rowResult['hashtag'], 1).'" class="text-secondary">'.$rowResult['hashtag'].'</a>&nbsp;';
                }
            }
           echo '</h3>';
        }
    }
?>


<?php
$albumQuery = "SELECT tbalbum.albumID As 'albumID',tbalbum.userID AS 'userID', tbalbum.privacy ,tbalbumparticipant.userID AS 'PuserID'
            FROM tbalbum
            LEFT JOIN tbalbumparticipant ON tbalbum.albumID = tbalbumparticipant.albumID
            WHERE tbalbum.albumID = ".$_GET['albumID']." OR tbalbumparticipant.albumID = ".$_GET['albumID'];

    $res = $mysqli->query($albumQuery);
    if ($res && $res->num_rows > 0)
    {
        $numRows = $res->num_rows;
        $resArray = $res->fetch_all(MYSQLI_ASSOC);// Fetch all
        //$res->free_result(); // Free result set
        //print_r($resArray);

        $ownerAcess = false;
        $participantAccess = false;
        $viewAccessPrivate = false;
        $viewAccessPublic = false;

        if ($resArray[0]['userID'] == $_SESSION['userID'])
        {
            $ownerAcess = true;
        }
        else
        {
            for ($x = 0; $x < $numRows; $x++)
            {
                if ($resArray[0]['PuserID'] == $_SESSION['userID'])
                {
                    $participantAccess = true;
                    break;
                }
            }

            if (!$participantAccess)
            {
                if ($resArray[0]['privacy'] == 'private')
                    $viewAccessPrivate = true;
                else
                    $viewAccessPublic = true;
            }
        }

        if ($ownerAcess || $participantAccess)
        {
            if ($ownerAcess)
            {
                $hasClickedUpdate = false;

                echo '<div class="pageContent">
                        <div class="row">
                            <div class="col-4"><a class="btn btn-secondary col-12 m-1 text-white adminBtn" data-toggle="modal" data-target="#editAlbum_View"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Album</a></div>
                            <div class="col-4"><a class="btn btn-secondary col-12 m-1 text-white adminBtn" data-toggle="modal" data-target="#addFriend_View"><i class="fa fa-plus" aria-hidden="true"></i> Add Friends</a></div>
                            <div class="col-4"><a class="btn btn-secondary col-12 m-1 text-white adminBtn" data-albumid="'.$_GET['albumID'].'" id="deleteAlbum"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Album</a></div>
                        </div>
                    </div>';

                echo '<div class="modal fade product_view" id="editAlbum_View">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Edit '.$editAlbumTitle.'</h3>
                                <a href="#" data-dismiss="modal" class="class pull-right"><i class="fa fa-remove fa-2x"></i></a>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <section id="forms" >
                                        <div class="col-12">
                                            <div class="card">
                                                <form method="POST" action="">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6">
                                                                <label for="editTitle">Title:</label>
                                                                <input type="text" id="editTitle" value="'.$editAlbumTitle.'" class="form-control" placeholder="favourites" name="editTitle" autocomplete="off" required>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <label for="editDescription">Description:</label>
                                                                <input type="text" id="editDescription" value="'.$editAlbumDescription.'" class="form-control" placeholder="Describe your collection" name="editDescription" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-12 col-lg-6">
                                                                <label for="editHashtags">Hashtags:</label>
                                                                <input type="text" id="editHashtags" value="'.$editAlbumHashTags.'" class="form-control" placeholder="#awesome #YOLO #LOL" name="editHashtags" autocomplete="off" required>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <br/>';
                                                            if ($editAlbumPrivacy == 'private')
                                                            {
                                                                echo '<div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="editPrivacyOption" id="inlineRadio1" value="public">
                                                                    <label class="form-check-label" for="inlineRadio1"><i class="fa fa-unlock" aria-hidden="true"></i> Public</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="editPrivacyOption" id="inlineRadio2" value="private" checked>
                                                                    <label class="form-check-label" for="inlineRadio2"><i class="fa fa-lock" aria-hidden="true"></i> Private</label>
                                                                </div>';
                                                            }
                                                            else
                                                            {
                                                                echo '<div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="editPrivacyOption" id="inlineRadio1" value="public" checked>
                                                                    <label class="form-check-label" for="inlineRadio1"><i class="fa fa-unlock" aria-hidden="true"></i> Public</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="editPrivacyOption" id="inlineRadio2" value="private">
                                                                    <label class="form-check-label" for="inlineRadio2"><i class="fa fa-lock" aria-hidden="true"></i> Private</label>
                                                                </div>';
                                                            }
                                                            echo '</div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-12">
                                                                <button type="submit" id="editisterBtn" class="btn btn-dark submitButton">Updte <i class="fa fa-angle-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>';

                if (isset($_SESSION['userID']) && isset($_GET['albumID']) && isset($_POST['editTitle']) && isset($_POST['editDescription']) && isset($_POST['editHashtags']) && isset($_POST['editPrivacyOption']))
                {
                    $successfullyAdded = true;

                    $editPrivacyOption = test_input($_POST['editPrivacyOption']);
                    $albumID = $_GET['albumID'];
                    $editTitle = test_input($_POST['editTitle']);
                    $editDescription = test_input($_POST['editDescription']);
                    $editHashtags = test_input($_POST['editHashtags']);

                    $query = "UPDATE tbalbum
                            SET title = '$editTitle', description= '$editDescription',privacy = '$editPrivacyOption', timeStamp = NOW()
                            WHERE albumID = '$albumID';";

                    $res = $mysqli->query($query);
                    if (!$res)
                        $successfullyAdded = false;

                    $query = "DELETE
                            FROM tbalbumhashtag
                            WHERE albumID = ".$albumID;

                    $res = $mysqli->query($query);
                    if (!$res)
                        $successfullyAdded = false;

                    if ($successfullyAdded)
                    {
                        function getHashtagsd($hashtags)
                        {
                            preg_match_all("/(#\w+)/u", $hashtags, $matches);

                            if ($matches)
                            {
                                return $matches[0];
                            }
                        }

                        $hashtagarray = getHashtagsd($editHashtags);
                        //print_r($hashtagarray);
                        for($i = 0; $i < count($hashtagarray); $i++)
                        {
                            $query = "INSERT INTO tbalbumhashtag(albumID,hashtag) VALUES ('$albumID','".$hashtagarray[$i]."')";
                            $res = $mysqli->query($query);
                            if (!$res)
                                $successfullyAdded = false;
                        }
                    }

                    if (!$successfullyAdded)
                    {
                        echo '<br/><br/>
                                <div class="container">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      <strong>Something went wrong, please try again later</strong>
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                </div>';
                    }
                    else
                    {
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }
            echo '<div class="modal fade product_view" id="addFriend_View">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Share Album with Friends</h3>
                                <a href="#" data-dismiss="modal" class="class pull-right"><i class="fa fa-remove fa-2x"></i></a>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <section id="forms" >
                                        <div class="col-12">
                                            <div class="card">
                                                    <div class="card-body">
                                                        <div class="row friends">';

                                                        $friendsQuery = "SELECT *
                                                                        FROM tbuser u
                                                                        INNER JOIN tbfollower f1 ON f1.userIDFollowing = u.userID
                                                                        INNER JOIN tbfollower f2 ON f1.userIDFollowing = f2.userIDFollower
                                                                        WHERE f1.userIDFollower = ".$_SESSION['userID'];

                                                        $res = $mysqli->query($friendsQuery);
                                                        if ($res && $res->num_rows > 0)
                                                        {
                                                            while($row = $res->fetch_assoc())
                                                            {
                                                                echo '<div  class="col-12 mb-2">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="card-header col-10">
                                                                                    <div class="row">
                                                                                        <div class="col-10 float-left align-self-center text-dark"><h3>'.$row['name'].'</h3></div>
                                                                                        <div class="col-2"><img class="float-right" src="../gallery/profilePics/'.$row['profileImage'].'" height="50"></div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-2">';
                                                                                    $friendAlbumParticipant = "SELECT *
                                                                                            FROM tbalbumparticipant
                                                                                            WHERE albumID = ".$_GET['albumID']." AND userID = ".$row['userID'];

                                                                                    $PartResult = $mysqli->query($friendAlbumParticipant);
                                                                                    if ($PartResult && $PartResult->num_rows > 0)
                                                                                    {
                                                                                        echo '<a data-albumid ="'.$_GET['albumID'].'" data-userid="'.$row['userID'].'" class="btn btn-dark text-white friendFunc removeParticipant">Remove <i class="fa fa-times fa-2x" aria-hidden="true"></i></a>';
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo '<a data-albumid ="'.$_GET['albumID'].'" data-userid="'.$row['userID'].'" class="btn btn-dark text-white friendFunc addParticipant">Add <i class="fa fa-check fa-2x" aria-hidden="true"></i></a>';
                                                                                    }
                                                                                echo '</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>';
                                                            }
                                                        }
                                                    echo '</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>';

            }

            //Add Post
            include "./fragments/addPostFragment.php";

            $infoMsg = "Oooops, Looks like you dont have any Posts in this Album. Create your first Posts by clicking the plus in the bottom right";
            $query = "SELECT *
            FROM tbpost
            WHERE albumID = ".$_GET['albumID']."
            ORDER BY timeStamp DESC;";
            include "./fragments/postsFragment.php";
        }
        else if ($viewAccessPublic)
        {
            //Only view Posts
            $infoMsg = "Oooops, Looks like there are no Posts in this Album.";
            $query = "SELECT *
            FROM tbpost
            WHERE albumID = ".$_GET['albumID']."
            ORDER BY timeStamp DESC;";
            include "./fragments/postsFragment.php";
        }
        else if ($viewAccessPrivate)
        {
            echo '<br/><br/>
                    <div class="container">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Whoooops, Looks like you dont have access to view this Album</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    </div>';
        }

    }
    else
    {
        echo '<br/><br/>
                    <div class="container">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>Something went wrong, please try again later</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    </div>';
    }

?>

    <?php include "./fragments/jsLibraries.php"; ?>
    <script src="../js/album.js"></script>
    <script src="../js/postsFragment.js"></script>
</body>
</html>


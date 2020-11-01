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
    <link rel="stylesheet" type="text/css" href="../css/albums.css" />
    <link rel="stylesheet" type="text/css" href="../css/albumsFragment.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php"; ?>

<div  class="heading">
    <h1>My Albums</h1>
</div>

<?php
$query1 = "SELECT *
    FROM tbalbum
    WHERE userID = ".$_SESSION['userID']."
    ORDER BY timeStamp DESC;";

$query2 = "SELECT *
    FROM tbalbum
    INNER JOIN tbalbumparticipant ON tbalbum.albumID = tbalbumparticipant.albumID
    WHERE tbalbum.userID = ".$_SESSION['userID']." OR tbalbumparticipant.userID = ".$_SESSION['userID']."
    ORDER BY tbalbum.timeStamp DESC;";

$infoMsg = "Oooops, Looks like you dont have any Albums. Create your first Album by clicking the plus in the bottom right";

include "./fragments/albumsFragment.php";
?>



<section id="newAlbum">
    <a class="fab" id="newFab" data-toggle="modal" data-target="#newAlbum_View"> + </a>
</section>

<div class="modal fade product_view" id="newAlbum_View">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">New Album</h3>
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
                                                <label for="regTitle">Title:</label>
                                                <input type="text" id="regTitle" class="form-control" placeholder="favourites" name="regTitle" autocomplete="off" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="regDescription">Description:</label>
                                                <input type="text" id="regDescription" class="form-control" placeholder="Describe your collection" name="regDescription" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-lg-6">
                                                <label for="regHashtags">Hashtags:</label>
                                                <input type="text" id="regHashtags" class="form-control" placeholder="#awesome #YOLO #LOL" name="regHashtags" autocomplete="off" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <br/>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="privacyOption" id="inlineRadio1" value="public" checked>
                                                    <label class="form-check-label" for="inlineRadio1"><i class="fa fa-unlock" aria-hidden="true"></i> Public</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="privacyOption" id="inlineRadio2" value="private">
                                                    <label class="form-check-label" for="inlineRadio2"><i class="fa fa-lock" aria-hidden="true"></i> Private</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <button type="submit" id="registerBtn" class="btn btn-dark submitButton">Create <i class="fa fa-angle-right"></i></button>
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
</div>

<?php

    if (isset($_POST["regTitle"]) && isset($_POST["regDescription"]) && isset($_POST["regHashtags"]) && isset($_POST["privacyOption"]))
    {
        $successfullyAdded = true;

        $privacy = $_POST['privacyOption'];
        $userID = $_SESSION['userID'];
        $regTitle = $_POST['regTitle'];
        $regDescription = $_POST['regDescription'];
        $regHashtags = $_POST['regHashtags'];
        $query = "INSERT INTO tbalbum (userID, title, description, privacy,timeStamp) VALUES ('$userID', '$regTitle', '$regDescription', '$privacy', NOW());";
        $res = $mysqli->query($query);
        if (!$res)
            $successfullyAdded = false;

        $newAlbumID = $mysqli->insert_id;
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

            $hashtagarray = getHashtagsd($regHashtags);
            //print_r($hashtagarray);
            for($i = 0; $i < count($hashtagarray); $i++)
            {
                $query = "INSERT INTO tbalbumhashtag(albumID,hashtag) VALUES ('$newAlbumID','".$hashtagarray[$i]."')";
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
?>

<?php include "./fragments/jsLibraries.php"; ?>
<script src="../js/albums.js"></script>
<script src="../js/albumsFragment.js"></script>

</body>
</html>


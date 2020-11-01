<section class="newPost">
    <a class="fab" id="newFab" data-toggle="modal" data-target="#newPost_View"> + </a>
</section>

<div class="modal fade product_view" id="newPost_View">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">New Post</h3>
                <a href="#" data-dismiss="modal" class="class pull-right"><i class="fa fa-remove fa-2x"></i></a>
            </div>
            <div class="modal-body">
                <div class="container">
                    <section id="forms">
                        <div class="col-12">
                            <div class="card">
                                <form method="POST" action="" enctype='multipart/form-data'>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <label for="regTitle">Title:</label>
                                                <input type="text" id="regTitle" class="form-control" placeholder="A dash of life" name="regTitle" autocomplete="off" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="regCaption">Caption:</label>
                                                <input type="text" id="regCaption" class="form-control" placeholder="The story of my life" name="regCaption" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-lg-6">
                                                <label for="regHashtags">Hashtags:</label>
                                                <input type="text" id="regHashtags" class="form-control" placeholder="#awesome #YOLO #LOL" name="regHashtags" autocomplete="off" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="regAlbum">Album:</label>
                                                <select id="regAlbum" class="form-control" name="regAlbum" autocomplete="off" required>
                                                    <?php
                                                    if (isset($_GET['albumID']))
                                                    {
                                                        $getAlbumQuery = "SELECT *
                                                                        FROM tbalbum
                                                                        WHERE albumID = ".$_GET['albumID'].";";
                                                        $res = $mysqli->query($getAlbumQuery);
                                                        if ($res && $res->num_rows > 0)
                                                        {
                                                            while($row = $res->fetch_assoc())
                                                            {
                                                                echo ' <option selected="selected" value="'.$row["albumID"].'">'.$row["title"].'</option>';
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo '<option selected="selected" disabled="true">Select Album</option>';

                                                        $query1 = "SELECT tbalbum.albumID, tbalbum.title
                                                                    FROM tbalbum
                                                                    LEFT JOIN tbalbumparticipant ON tbalbum.albumID = tbalbumparticipant.albumID
                                                                    WHERE tbalbum.userID = ".$_SESSION['userID']." OR tbalbumparticipant.userID = ".$_SESSION['userID']. "
                                                                    UNION ALL
                                                                    SELECT tbalbum.albumID, tbalbum.title
                                                                    FROM tbalbum
                                                                    RIGHT JOIN tbalbumparticipant ON tbalbum.albumID = tbalbumparticipant.albumID
                                                                    WHERE tbalbum.userID = ".$_SESSION['userID']." OR tbalbumparticipant.userID = ".$_SESSION['userID'];
                                                        $res = $mysqli->query($query1);

                                                        if ($res && $res->num_rows > 0)
                                                        {
                                                            while($row = $res->fetch_assoc()) {
                                                                echo ' <option value="'.$row["albumID"].'">'.$row["title"].'</option>';
                                                            }
                                                        }
                                                        else if($res->num_rows == 0)
                                                        {
                                                            $userID = $_SESSION['userID'];
                                                            $query2 = "INSERT INTO tbalbum (userID, title, description, privacy,timeStamp) VALUES ('$userID', 'Welcome Album', 'My First Album', 'private', NOW());";
                                                            $res = $mysqli->query($query2);
                                                            $newAlbumID = $mysqli->insert_id;
                                                            if ($res)
                                                            {
                                                                echo ' <option value="'.$newAlbumID.'">Welcome Album</option>';

                                                                $query = "INSERT INTO tbalbumhashtag(albumID,hashtag) VALUES ('$newAlbumID','#Welcome')";
                                                                $res = $mysqli->query($query);
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="form-row col-12">
                                                <div class="col-3">
                                                    <small class="form-text text-muted mb-1">ISO</small>
                                                    <label class="sr-only"  for="regISO">
                                                    </label><input type="number" min="0" step="1" class="form-control" id="regISO" name="regISO" placeholder="100" autocomplete="off" required>
                                                </div>
                                                <div class="col-3">
                                                    <small class="form-text text-muted mb-1">Shutter</small>
                                                    <label class="sr-only"  for="regShutter"></label>
                                                    <input type="text" class="form-control" id="regShutter" name="regShutter" placeholder="1/200" autocomplete="off" required>
                                                </div>
                                                <div class="col-3">
                                                    <small class="form-text text-muted mb-1">&fnof; Stop</small>
                                                    <label class="sr-only"  for="regFStop"></label>
                                                    <input type="number" step="0.1" class="form-control" id="regFStop" name="regFStop" placeholder="&fnof;2.8" autocomplete="off" required>
                                                </div>
                                                <div class="col-3">
                                                    <small class="form-text text-muted mb-1">Lens</small>
                                                    <label class="sr-only"  for="regLens"></label>
                                                    <input type="text" class="form-control" id="regLens" name="regLens" placeholder="200mm" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <label class="sr-only" for="regPicture">Picture:</label>
                                                <input type="file" id="regPicture" class="form-control" name="regPicture" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-12 m-3 text-center" id="pImg"><img id="previewImg"></div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <button type="submit" id="registerBtn" class="btn btn-dark submitButton">Post <i class="fa fa-angle-right"></i></button>
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

if (isset($_POST["regTitle"]) && isset($_POST["regCaption"]) && isset($_POST["regHashtags"]) && isset($_POST["regAlbum"]) && isset($_POST["regISO"]) && isset($_POST["regShutter"])
    && isset($_POST["regFStop"]) && isset($_POST["regLens"]) && $_FILES['regPicture']['name'] !== "" )//isset($_POST["regPicture"])
{

    $pictureIsValid = true;

    $target_dir = "../gallery/";
    $uploadFile = $_FILES["regPicture"];
    $target_file = $target_dir . basename(time()."-".$uploadFile["name"]);

    $check = getimagesize($_FILES["regPicture"]["tmp_name"]);
    if($check === false  && $pictureIsValid)
    {
        $pictureIsValid = false;
        echo '<br/><br/>
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong> Image file is not what you think it is ;)</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>';
    }

    $allowFileExtensions = array("jpg", "jpeg","png","gif");
    $filename = $_FILES['regPicture']['name'];
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $allowFileExtensions) && $pictureIsValid)
    {
        $pictureIsValid = false;
        echo '<br/><br/>
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Selected Image file type is invalid</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>';
    }

    if ($_FILES["regPicture"]["size"] > 8388608 && $pictureIsValid) //1024000
    {
        $pictureIsValid = false;
        echo '<br/><br/>
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong> Selected Image is too large</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>';
    }

    if ($pictureIsValid == true)
    {
        if (move_uploaded_file($_FILES["regPicture"]["tmp_name"], $target_file) === false)
        {
            echo '<br/><br/>
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>There was an Error Uploading your Selected Image</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>';
        }
        else
        {
            $successfullyAdded = true;

            $userID = $_SESSION['userID'];
            $regTitle = $_POST['regTitle'];
            $regCaption = $_POST['regCaption'];
            $regHashtags = $_POST['regHashtags'];
            $regAlbum = $_POST['regAlbum'];
            $regISO = $_POST['regISO'];
            $regShutter = $_POST['regShutter'];
            $regFStop = $_POST['regFStop'];
            $regLens = $_POST['regLens'];
            $regPicture = $_POST['regPicture'];
            $query = "INSERT INTO tbpost (userID, title, caption, timeStamp, fileLocation, iso, shutterSpeed, fStop, lens, albumID) VALUES ('$userID', '$regTitle', '$regCaption', NOW(), '$target_file',
                        '$regISO','$regShutter','$regFStop','$regLens','$regAlbum');";

            $res = $mysqli->query($query);
            if (!$res)
                $successfullyAdded = false;

            $newImageID = $mysqli->insert_id;
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
                    $query = "INSERT INTO tbposthashtag(imageID,hashtag) VALUES ('$newImageID','".$hashtagarray[$i]."')";
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
    }
}
?>
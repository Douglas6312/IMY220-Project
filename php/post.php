<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php"; ?>
    <link rel="stylesheet" type="text/css" href="../css/post.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php"; ?>

<?php

$AdminAccess = false;

$getUserQuery = "SELECT *
                    FROM tbuser
                    WHERE userID = ".$_SESSION['userID'].";";
$result = $mysqli->query($getUserQuery);
if ($result && $result->num_rows > 0)
{
    while($rowResult = $result->fetch_assoc())
    {
        if ($rowResult["userType"] == 'admin')
            $AdminAccess = true;
    }
}

$ownerID = '';
$ownerName = '';
$editPostTitle = '';
$editPostCaption = '';
$editPostISO = '';
$editPostShutterSpeed = '';
$editPostFStop = '';
$editPostLens = '';
$editPostAlbumID = '';
$editPostFileLocation = '';
$editPostHashtags = '';
$postStars = '';
$postPrivacy = '';

$postInfoQuery = "SELECT *
                    FROM tbpost
                    WHERE imageID = ".$_GET['imageID'].";";

$res = $mysqli->query($postInfoQuery);
if ($res && $res->num_rows > 0)
{
    while($row = $res->fetch_assoc())
    {

        $ownerID = $row['userID'];
        $editPostTitle = $row['title'];
        $editPostCaption =  $row['caption'];
        $editPostISO =  $row['iso'];
        $editPostShutterSpeed =  $row['shutterSpeed'];
        $editPostFStop =  $row['fStop'];
        $editPostLens =  $row['lens'];
        $editPostAlbumID = $row['albumID'];
        $editPostFileLocation = $row['fileLocation'];
        $postStars = $row['stars'];
        $postPrivacy = $row['privacy'];

        echo '<div class="heading">
            <h1>
            <a href="#" class="goBack"><i class="fa fa-arrow-left text-secondary" aria-hidden="true"></i></a> 
             '.$row['title'];
        echo '<span class="float-right">';
        $getUserQuery = "SELECT *
                            FROM tbuser
                            WHERE userID = ".$row['userID'].";";
        $result = $mysqli->query($getUserQuery);
        if ($result && $result->num_rows > 0)
        {
            while($rowResult = $result->fetch_assoc())
            {
                $ownerName = $rowResult["name"];
                echo '<a href="./profile.php?userID='.$rowResult["userID"].'" class="text-secondary">'.$rowResult["name"].'</a>';
            }
        }
        echo '</span>
            </h1>
           </div>
           <h3 class="pageContent2">'.$row['caption'].'&nbsp;&nbsp;';
        $getHashtagsQuery = "SELECT *
                            FROM tbposthashtag
                            WHERE imageID = ".$_GET['imageID'].";";
        $result = $mysqli->query($getHashtagsQuery);
        if ($result && $result->num_rows > 0)
        {
            while($rowResult = $result->fetch_assoc())
            {
                $editPostHashtags .= $rowResult['hashtag'].' ';
                echo '<a href="./explore.php?hashtag='.substr($rowResult['hashtag'], 1).'" class="text-secondary">'.$rowResult['hashtag'].'</a>&nbsp;';
            }
        }
        if ($postPrivacy == 'hidden')
        {
            echo '<span class="btn btn-danger col-4 m-1 text-white float-right"><i class="fa fa-exclamation" aria-hidden="true"></i> This post has been reported more than 5 times, it is now HIDDEN</span>';
        }
        if ($_SESSION['userID'] != $ownerID && !$AdminAccess)
        {
            $getReportsQuery = "SELECT *
                            FROM tbpostreports
                            WHERE userID = ".$_SESSION['userID']." AND imageID = ".$_GET['imageID']." ;";
            $result = $mysqli->query($getReportsQuery);
            if ($result && $result->num_rows > 0)
            {
                echo '<span class="btn btn-danger col-1 m-1 text-white float-right"><i class="fa fa-exclamation" aria-hidden="true"></i> Reported</span>';
            }
            else
            {
                echo '<span id="reportPostBtn">
                            <div class="dropdown reportDropdown d-inline float-right col-1 m-1 text-white">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation" aria-hidden="true"></i> Report Post
                              </button>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">';
                                $getReprtReasonsQuery = "SELECT *
                                            FROM tbpostreportreason ;";
                                $result = $mysqli->query($getReprtReasonsQuery);
                                if ($result && $result->num_rows > 0)
                                {
                                    while($rowResult = $result->fetch_assoc())
                                    {
                                        echo '<a data-imageid="'.$_GET['imageID'].'" data-reasonid="'.$rowResult['ID'].'" class="dropdown-item reportPost" href="#">'.$rowResult['reason'].'</a>';
                                    }
                                }
                             echo '</div>
                            </div>
                    </span>';
            }
        }
        echo '</h3>';
    }
}


if ($_SESSION['userID'] == $ownerID || $AdminAccess)
{
    echo '<div class="pageContent">
            <div class="row">
                <div class="col-6"><a class="btn btn-secondary col-12 m-1 text-white adminBtn" data-toggle="modal" data-target="#editPost_View" ><i class="fa fa-pencil" aria-hidden="true"></i> Edit Post</a></div>
                <div class="col-6"><a class="btn btn-secondary col-12 m-1 text-white adminBtn" data-imageid="'.$_GET['imageID'].'" id="deleteImage"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Post</a></div>
            </div>
        </div>';

    echo '<div class="modal fade product_view" id="editPost_View">
            <div class="modal-dialog">
                <div class="modal-content p-0 m-0">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Post</h3>
                        <a href="#" data-dismiss="modal" class="class pull-right"><i class="fa fa-remove fa-2x"></i></a>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <section id="forms">
                                <div class="col-12>
                                    <div class="card">
                                        <form method="POST" action="" enctype="multipart/form-data">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-lg-6">
                                                        <label for="editTitle">Title:</label>
                                                        <input type="text" id="editTitle" value="'.$editPostTitle.'" class="form-control" placeholder="A dash of life" name="editTitle" autocomplete="off" required>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <label for="editCaption">Caption:</label>
                                                        <input type="text" id="editCaption" value="'.$editPostCaption.'" class="form-control" placeholder="The story of my life" name="editCaption" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-12 col-lg-6">
                                                        <label for="editHashtags">Hashtags:</label>
                                                        <input type="text" id="editHashtags" value="'.$editPostHashtags.'" class="form-control" placeholder="#awesome #YOLO #LOL" name="editHashtags" autocomplete="off" required>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <label for="editAlbum">Album:</label>
                                                        <select id="editAlbum" class="form-control" name="editAlbum" autocomplete="off" required>';
                                                            $getAlbumInfo = "SELECT *
                                                                            FROM tbalbum
                                                                            WHERE albumID = ".$editPostAlbumID.";";

                                                            $result = $mysqli->query($getAlbumInfo);
                                                            if ($result && $result->num_rows > 0)
                                                            {
                                                                while($rowResult = $result->fetch_assoc())
                                                                {
                                                                    echo ' <option selected="selected" value="'.$editPostAlbumID.'">'.$rowResult["title"].'</option>';
                                                                }
                                                            }
                                                       echo '</select>
                                                    </div>
                                                </div>
        
                                                <div class="row mt-3">
                                                    <div class="form-row col-12">
                                                        <div class="col-3">
                                                            <small class="form-text text-muted mb-1">ISO</small>
                                                            <label class="sr-only"  for="editISO">
                                                            </label><input type="number" min="0" step="1" value="'.$editPostISO.'" class="form-control" id="editISO" name="editISO" placeholder="100" autocomplete="off" required>
                                                        </div>
                                                        <div class="col-3">
                                                            <small class="form-text text-muted mb-1">Shutter</small>
                                                            <label class="sr-only"  for="editShutter"></label>
                                                            <input type="text" class="form-control" id="editShutter" value="'.$editPostShutterSpeed.'" name="editShutter" placeholder="1/200" autocomplete="off" required>
                                                        </div>
                                                        <div class="col-3">
                                                            <small class="form-text text-muted mb-1">&fnof; Stop</small>
                                                            <label class="sr-only"  for="editFStop"></label>
                                                            <input type="number" step="0.1" class="form-control" id="editFStop" value="'.$editPostFStop.'" name="editFStop" placeholder="&fnof;2.8" autocomplete="off" required>
                                                        </div>
                                                        <div class="col-3">
                                                            <small class="form-text text-muted mb-1">Lens</small>
                                                            <label class="sr-only"  for="editLens"></label>
                                                            <input type="text" class="form-control" id="editLens" value="'.$editPostLens.'" name="editLens" placeholder="200mm" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <label class="sr-only" for="editPicture">Picture:</label>
                                                        <input type="file" id="editPicture" class="form-control" name="editPicture" autocomplete="off" required disabled>
                                                    </div>
                                                </div>
                                                <div class="col-12 m-3 text-center" id="pImg"><img src="../gallery/'.$editPostFileLocation.'" id="previewImg"></div>
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <button type="submit" id="editBtn" class="btn btn-dark submitButton">Update <i class="fa fa-angle-right"></i></button>
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

    if (isset($_POST["editTitle"]) && isset($_POST["editCaption"]) && isset($_POST["editHashtags"]) && isset($_POST["editAlbum"]) && isset($_POST["editISO"]) && isset($_POST["editShutter"])
        && isset($_POST["editFStop"]) && isset($_POST["editLens"]))
    {
        $successfullyAdded = true;

        $userID = $_SESSION['userID'];
        $editTitle =  test_input($_POST['editTitle']);
        $editCaption =  test_input($_POST['editCaption']);
        $editHashtags =  test_input($_POST['editHashtags']);
        $editAlbum =  test_input($_POST['editAlbum']);
        $editISO =  test_input($_POST['editISO']);
        $editShutter =  test_input($_POST['editShutter']);
        $editFStop =  test_input($_POST['editFStop']);
        $editLens =  test_input($_POST['editLens']);
        $imageID = $_GET['imageID'];

        $query = "UPDATE tbpost
                SET title = '$editTitle', caption = '$editCaption',iso = '$editISO', shutterSpeed = '$editShutter',fStop = '$editFStop', lens = '$editLens'
                WHERE imageID = '$imageID';";

        $res = $mysqli->query($query);
        if (!$res)
            $successfullyAdded = false;

        $query = "DELETE
                FROM tbposthashtag
                WHERE imageID = ".$imageID;

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
                $query = "INSERT INTO tbposthashtag(imageID,hashtag) VALUES ('$imageID','".$hashtagarray[$i]."')";
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

echo '<main class="container-fluid pageContent">
    <div class="row">
        <div class="col-8">
            <table class="table table-bordered text-center">
              <thead>
                <tr class="text-center">';
                    $getAlbumInfo = "SELECT *
                                    FROM tbalbum
                                    WHERE albumID = ".$editPostAlbumID.";";

                    $result = $mysqli->query($getAlbumInfo);
                    if ($result && $result->num_rows > 0)
                    {
                        while($rowResult = $result->fetch_assoc())
                        {
                            echo '<th class="text-center"><h4><i class="fa fa-picture-o" aria-hidden="true"></i> '.$rowResult['title'].'</h4></th>';
                        }
                    }
                 echo '<th class="text-center"><h4>ISO '.$editPostISO.'</h4></th>
                  <th class="text-center"><h4>'.$editPostShutterSpeed.'</h4></th>
                  <th class="text-center"><h4>&fnof;'.$editPostFStop.'</h4></th>
                  <th class="text-center"><h4>'.$editPostLens.'</h4></th>
                  <th class="text-center"><h4><i class="fa fa-star fa-1x text-warning" aria-hidden="true"></i><b>'.$postStars.'</b></h4></th>
                </tr>
              </thead>
            </table>
        </div>
    </div>
    <div class="row mb-5">
        <img src="../gallery/'.$editPostFileLocation.'" class="col-8">
        <div class="col-4">
          <h3 class="mb-3 col-12"> <i class="fa fa-comment-o" aria-hidden="true"></i> Comments <a data-imageid="'.$_GET['imageID'].'" class="btn btn-secondary float-right text-white col-sm-12 col-lg-5 addComment">New Comment</a></h3>
            <div class="row postComments">
                <div class="mb-1 mt-1">
                    <div class="card">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 comments">';
                            $postCommentsQuery = "SELECT *
                                                FROM tbpostcomment
                                                INNER JOIN tbuser t on tbpostcomment.userID = t.userID
                                                WHERE imageID = ".$_GET['imageID'].";";

                            $res = $mysqli->query($postCommentsQuery);
                            if ($res && $res->num_rows > 0)
                            {
                                while($row = $res->fetch_assoc())
                                {
                                    echo '<div class="media mb-2">
                                            <a href="./profile.php?userID='.$row["userID"].'" class="text-dark"><img class="mr-3 rounded-circle" alt="avatar" src="../gallery/profilePics/'.$row['profileImage'].'" /></a>
                                            <div class="media-body">
                                                <div class="row">
                                                    <div class="col-8 d-flex">
                                                        <h5><a href="./profile.php?userID='.$row["userID"].'" class="text-dark">'.$row['name'].'</a></h5>
                                                    </div>
                                                </div> '.$row['comment'].'
                                            </div>
                                        </div>';
                                }
                            }
                            echo ' </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</main>';

?>

    <?php include "./fragments/jsLibraries.php"; ?>
    <script src="../js/post.js"></script>
</body>
</html>

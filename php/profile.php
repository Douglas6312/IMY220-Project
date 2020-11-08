<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php"; ?>
    <link rel="stylesheet" type="text/css" href="../css/profile.css" />
    <link rel="stylesheet" type="text/css" href="../css/postsFragment.css" />
    <link rel="stylesheet" type="text/css" href="../css/albumsFragment.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php"; ?>


<?php

    $adminAccess = false;
    $ownerAccess  = false;
    $viewerAccess = false;

    $userType = '';
    $name = '';
    $email = '';
    $dob = '';
    $bio = '';
    $profileIMG = '';

    $userInfoQuery = "SELECT *
                        FROM tbuser
                        WHERE userID = ".$_GET['userID'].";";

    $res = $mysqli->query($userInfoQuery);
    if ($res && $res->num_rows > 0)
    {
        while ($row = $res->fetch_assoc())
        {
            $userType = $row['userType'];
            $name = $row['name'];
            $email = $row['email'];
            $dob = $row['dateOfBirth'];
            $bio = $row['bio'];
            $profileIMG = $row['profileImage'];
        }
    }

    $ViewerUserInfoQuery = "SELECT *
                    FROM tbuser
                    WHERE userID = ".$_GET['userID'].";";

    $res = $mysqli->query($ViewerUserInfoQuery);
    if ($res && $res->num_rows > 0)
    {
        while ($row = $res->fetch_assoc())
        {
            if ($row['userType'] == 'admin')
            {
                $adminAccess = true;
            }
        }
    }

    if ($_GET['userID'] == $_SESSION['userID'] && $adminAccess)
    {
        $ownerAccess = true;
        echo '<div  class="heading">
                    <h1>My Profile<span class="float-right text-danger"><i class="fa fa-user text-danger" aria-hidden="true"></i> Admin</span></h1>
                </div>';
    }
    else if($adminAccess)
    {
        echo '<div  class="heading">
                    <h1>'.$name.'<span class="float-right text-danger"><i class="fa fa-user text-danger" aria-hidden="true"></i> Admin</span></h1>
                </div>';
    }
    else if ($_GET['userID'] == $_SESSION['userID'])
    {
        $ownerAccess = true;
        echo '<div  class="heading">
                    <h1> My Profile <span class="float-right"><i class="fa fa-user" aria-hidden="true"></i> User</span></h1>
                </div>';
    }
    else
    {
        $viewerAccess = true;
        echo '<div  class="heading">
                <h1>'.$name.'<span class="float-right"><i class="fa fa-user" aria-hidden="true"></i> User</span></h1>
            </div>';
    }


    if ($ownerAccess || $adminAccess)
    {
        echo '<div class="pageContent">
                <div class="row">
                    <div class="col-md-12 col-lg-4"><a class="btn btn-secondary col-12 m-1 text-white" data-toggle="modal" data-target="#addProfilePhoto_View"><i class="fa fa-camera" aria-hidden="true"></i> Add Profile Picture</a></div>
                    <div class="col-md-12 col-lg-4"><a class="btn btn-secondary col-12 m-1 text-white" data-toggle="modal" data-target="#editProfile_View"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a></div>
                    <div class="col-md-12 col-lg-4"><a class="btn btn-secondary col-12 m-1 text-white" data-userid="'.$_GET['userID'].'" id="deleteUser"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Profile</a></div>
                </div>
            </div>';

        echo '    <div class="modal fade product_view" id="addProfilePhoto_View">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Add Profile Picture</h3>
                                <a href="#" data-dismiss="modal" class="class pull-right"><i class="fa fa-remove fa-2x"></i></a>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <section id="forms">
                                        <div class="col-12">
                                            <div class="card">
                                                <form method="POST" action="" enctype="multipart/form-data">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label class="sr-only" for="regPicture">Picture:</label>
                                                                <input type="file" id="regPicture" class="form-control" name="regPicture" autocomplete="off" required>
                                                            </div>
                                                            <div class="col-12 m-3 text-center" id="pImg"><img id="previewImg" class="rounded-circle" height="200" width="200"></div>
                                                            <div class="col-12">
                                                                <button type="submit" id="addProfilePicBtn" class="btn btn-dark submitButton">Post <i class="fa fa-angle-right"></i></button>
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

        if (isset($_FILES['regPicture']['name']) && $_FILES['regPicture']['name'] !== "" )
        {
            $pictureIsValid = true;

            $target_dir = "../gallery/profilePics/";
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

                    $query = "SELECT * FROM tbuser WHERE userID = ".$_GET['userID'];
                    $res = $mysqli->query($query);
                    if ($res && $res->num_rows > 0)
                    {
                        while ($row = $res->fetch_assoc())
                        {
                            if ($row['profileImage'] != '../gallery/profilePics/default.png')
                            {
                                $file_pointer = $row['profileImage'];

                                if (!unlink($file_pointer))
                                {
                                    $successfullyAdded = false;
                                }
                            }
                        }
                    }

                    $query = "UPDATE tbuser
                     SET profileImage = '$target_file' 
                     WHERE  userID = ".$_GET['userID'].";";

                    $_SESSION['userProfileImg'] = $target_file;

                    $res = $mysqli->query($query);
                    if (!$res)
                        $successfullyAdded = false;

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

        echo '<div class="modal fade product_view" id="editProfile_View">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Edit Profile</h3>
                            <a href="#" data-dismiss="modal" class="class pull-right"><i class="fa fa-remove fa-2x"></i></a>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <section id="forms" >
                                        <div class="col-12">
                                            <div class="card">
                                                <form method="POST" action="" id="registerForm">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6">
                                                                <label for="regName">Name:</label>
                                                                <input type="text" id="regName" value="'.$name.'" class="form-control" placeholder="John" name="regName" autocomplete="off" required>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <label for="regBio">Bio:</label>
                                                                <input type="text" id="regBio" value="'.$bio.'" class="form-control" placeholder="Tell us something about yourself" name="regBio" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-12">
                                                                <button type="submit" id="registerBtn" class="btn btn-dark submitButton">Update <i class="fa fa-angle-right"></i></button>
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


        if (isset($_POST["regName"]) && isset($_POST["regBio"]) )
        {
            $successfullyAdded = true;

            $regName = test_input($_POST["regName"]);
            $regBio = test_input($_POST["regBio"]);

            $query = "UPDATE tbuser
                SET name = '$regName', bio = '$regBio'
                WHERE userID = ".$_GET['userID'].";";

            $res = $mysqli->query($query);
            if (!$res)
                $successfullyAdded = false;

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

    echo '<main class="pageContent">
        <div class="row">
            <div class="col-4 col-lg-2"> <img class="rounded-circle ima" alt="avatar" height="200" width="200" src="'.$profileIMG.'" /></div>
            <div class="col-8 col-lg-10">
                <div class="row">
                    <div class="col">
                        <div data-type="text" class="mb-1">
                            <span class="h6">Name:</span> <b class="h4">'.$name.'</b>
                        </div>
                        <div data-type="email" class="mb-1">
                            <span class="h6">Email:</span> <b class="h4">'.$email.'</b>
                        </div>
                        <div data-type="date" class="mb-4">
                            <span class="h6">BIO:</span> <b class="h4">'.$bio.'</b>
                        </div>';
                            if (!$ownerAccess)
                            {
                                $isFollowerQuery = "SELECT *
                                                FROM tbfollower
                                                WHERE userIDFollower = ".$_SESSION['userID']." AND userIDFollowing = ".$_GET['userID'].";";
                                $res = $mysqli->query($isFollowerQuery);
                                if ($res && $res->num_rows > 0)
                                {
                                    echo ' <a class="btn btn-secondary text-white followBTN followBTNUnfollow" data-action="unfollow" data-follower="'.$_SESSION['userID'].'" data-following="'.$_GET['userID'].'" >Unfollow</a>';
                                }
                                else
                                {
                                    echo ' <a class="btn text-white followBTN followBTNFollow" data-action="follow" data-follower="'.$_SESSION['userID'].'" data-following="'.$_GET['userID'].'" >Follow</a>';
                                }
                            }
                    echo '</div>
                </div>
            </div>
        </div>
    </main>';

?>

<div class="pageContent">
    <div class="row">
        <div class="col-md-12 col-lg-4">
            <div  class="mt-3 headingFollowing">
                <h3> Following</h3>
            </div>
            <div class="list">
                <div class="row">
                    <?php
                    $userFollowingQuery = "SELECT *
                                    FROM tbuser
                                    INNER JOIN tbfollower t on tbuser.userID = t.userIDFollowing
                                    WHERE userIDFollower = ".$_GET['userID'].";";
                    $res = $mysqli->query($userFollowingQuery);
                    if ($res && $res->num_rows > 0)
                    {
                        while ($row = $res->fetch_assoc())
                        {
                            echo '<a href="./profile.php?userID='.$row['userID'].'" class="col-12 mb-1">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-10 float-left align-self-center text-dark"><strong>'.$row['name'].'</strong></div>
                                                <div class="col-2"><img class="float-right profileExplore rounded-circle" src="'.$row['profileImage'].'" height="50" width="50"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div  class="mt-3 headingFollowing">
                <h3> Followers</h3>
            </div>
            <div class="list">
                <div class="row">
                    <?php
                    $userFollowingQuery = "SELECT *
                                    FROM tbuser
                                    INNER JOIN tbfollower t on tbuser.userID = t.userIDFollower
                                    WHERE userIDFollowing = ".$_GET['userID'].";";
                    $res = $mysqli->query($userFollowingQuery);
                    if ($res && $res->num_rows > 0)
                    {
                        while ($row = $res->fetch_assoc())
                        {
                            echo '<a href="./profile.php?userID='.$row['userID'].'" class="col-12 mb-1">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-10 float-left align-self-center text-dark"><strong>'.$row['name'].'</strong></div>
                                               <div class="col-2"><img class="float-right profileExplore rounded-circle" src="'.$row['profileImage'].'" height="50" width="50"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div  class="mt-3 headingFollowing">
                <h3> Mutual Friends</h3>
            </div>
            <div class="list">
                <div class="row">
                    <?php
                    $userMutualFriendsQuery = "select *
                                                from tbuser
                                                where userID IN (select tbl1.userIDFollowing from tbfollower tbl1
                                                join tbfollower tbl2
                                                on tbl1.userIDFollowing =tbl2.userIDFollower
                                                where tbl1.userIDFollower = ".$_GET['userID']." and tbl2.userIDFollowing = ".$_GET['userID']." );";

                    $res = $mysqli->query($userMutualFriendsQuery);
                    if ($res && $res->num_rows > 0)
                    {
                        while ($row = $res->fetch_assoc())
                        {
                            echo '<a href="./profile.php?userID='.$row['userID'].'" class="col-12 mb-1">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-10 float-left align-self-center text-dark"><strong>'.$row['name'].'</strong></div>
                                                 <div class="col-2"><img class="float-right profileExplore rounded-circle" src="'.$row['profileImage'].'" height="50" width="50"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div  class="heading mt-3">
    <h2>Posts</h2>
</div>

<?php
$query = "SELECT *
    FROM tbpost
    WHERE userID = ".$_GET["userID"]."
    ORDER BY timeStamp DESC ;";

$infoMsg = "Oooops, Looks like user ".$name." does not have any Posts";
include "./fragments/postsFragment.php";
?>

<div  class="heading mt-3">
    <h2> Albums</h2>
</div>

<?php
$query1 = "SELECT *
    FROM tbalbum
    WHERE userID = ".$_SESSION['userID']."
    ORDER BY timeStamp DESC;";

$query2 = "SELECT *
    FROM tbalbum
    INNER JOIN tbalbumparticipant ON tbalbum.albumID = tbalbumparticipant.albumID
    WHERE tbalbumparticipant.userID = ".$_GET['userID']."
    ORDER BY tbalbum.timeStamp DESC;";
$infoMsg = "Oooops, Looks like user ".$name." does not have any Albums";

include "./fragments/albumsFragment.php";
?>
?>


    <?php include "./fragments/jsLibraries.php"; ?>
    <script src="../js/postsFragment.js"></script>
    <script src="../js/albumsFragment.js"></script>
    <script src="../js/profile.js"></script>
</body>
</html>
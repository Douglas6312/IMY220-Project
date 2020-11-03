<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Explore</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php"; ?>
    <link rel="stylesheet" type="text/css" href="../css/explore.css" />
    <link rel="stylesheet" type="text/css" href="../css/postsFragment.css" />
    <link rel="stylesheet" type="text/css" href="../css/albumsFragment.css" />
</head>
<body>

<?php
include "./fragments/navbarFragment.php";

if (isset($_GET['hashtag']))
{
    $_SESSION['searchValue'] = $_GET['hashtag'];
}
elseif (isset($_POST['searchValue']))
{
    $_SESSION['searchValue']  = $_POST['searchValue'];
}
elseif (!isset($_SESSION['searchValue']))
{
    $_SESSION['searchValue'] = '';
}

if (isset($_GET['hashtag']))
{
    $_SESSION['searchBy'] = 'hashtag';
}
elseif (isset($_POST['searchBy']))
{
    $_SESSION['searchBy']  = $_POST['searchBy'];
}
elseif (!isset($_SESSION['searchBy']))
{
    $_SESSION['searchBy'] = 'explore';
}

?>

<div class="pageContent mt-5">
    <h1>Explore</h1>
    <nav class="navbar navbar-dark default-color">
        <form class="form-inline ml-auto" method="POST" action="./explore.php" id="exploreForm" name="exploreForm">
            <label for="searchBy" class="sr-only">Search By</label>
            <select class="form-control col-4" name="searchBy" id="searchBy" autocomplete="off" required>
                <option value="explore" <?php if(isset($_SESSION['searchBy']) && $_SESSION['searchBy'] === 'explore'){echo 'selected' ;}else{ if(isset($_POST['searchBy']) && $_POST['searchBy'] === 'explore') echo 'selected' ;} ?> >Explore</option>
                <option value="post" <?php if(isset($_SESSION['searchBy']) && $_SESSION['searchBy'] === 'post'){echo 'selected' ;}else{ if(isset($_POST['searchBy']) && $_POST['searchBy'] === 'post') echo 'selected' ;} ?> >Post</option>
                <option value="album" <?php if(isset($_SESSION['searchBy']) && $_SESSION['searchBy'] === 'album'){echo 'selected' ;}else{if(isset($_POST['searchBy']) && $_POST['searchBy'] === 'album') echo 'selected'; }; ?> >Album</option>
                <option value="user" <?php if(isset($_SESSION['searchBy']) && $_SESSION['searchBy'] === 'user'){echo 'selected' ;}else{ if(isset($_POST['searchBy']) && $_POST['searchBy'] === 'user') echo 'selected' ;} ?> >User</option>
                <option value="hashtag"<?php if(isset($_SESSION['searchBy']) && $_SESSION['searchBy'] === 'hashtag'){echo 'selected' ;}else{if (isset($_POST['searchBy']) && $_POST['searchBy'] === 'hashtag') echo 'selected' ;} ''; ?> >Hashtag</option>
               <!-- <option value="all">All</option>-->
            </select>
            <label for="searchValue" class="sr-only">Album:</label>
            <input class="form-control col-6" type="search" placeholder="Search" value="<?php echo isset($_POST['searchValue']) ? $_POST['searchValue'] : $_SESSION['searchValue'] ; ?>" name="searchValue" aria-label="Search" autocomplete="off">
           <button class="btn col-2" type="submit"><i class="fa fa-search fa-2x text-white" aria-hidden="true"></i></button>
        </form>
    </nav>
</div>

<?php

     if( isset($_POST['searchBy']) || isset($_POST['searchValue']) )
    {
        $_SESSION['searchBy'] =  isset($_POST['searchBy']) ? test_input($_POST['searchBy']) : $_SESSION['searchBy'];
        $_SESSION['searchValue'] = isset($_POST['searchValue']) ? test_input($_POST['searchValue']) :  $_SESSION['searchValue'];
    }

    if(isset($_GET['hashtag']))
    {
        $_SESSION['searchValue'] =  $_GET['hashtag'];
        $_SESSION['searchBy'] = 'hashtag';

        $infoMsg = "Oooops, Looks like no match was found for your search for #".$_SESSION['searchValue'];

        echo '<div class="heading mt-3">
                <h1>Posts</h1>
            </div>';

        $query = "SELECT *
                FROM tbpost
                INNER JOIN tbposthashtag on tbpost.imageID = tbposthashtag.imageID
                WHERE tbposthashtag.hashtag LIKE '%".$_SESSION['searchValue']."%' ;";

        include "./fragments/postsFragment.php";

        echo '<div class="heading mt-2">
                <h1>Albums</h1>
            </div>';

        $query1 = "SELECT *
                FROM tbalbum
                INNER JOIN tbalbumhashtag on tbalbum.albumID = tbalbumhashtag.albumID
                WHERE tbalbumhashtag.hashtag LIKE '%".$_SESSION['searchValue']."%' ;";

        include "./fragments/albumsFragment.php";


        echo '<script type="text/javascript">location.href = \'./explore.php\';</script>';

    }
    if (isset($_SESSION['searchBy']) && $_SESSION['searchBy']  === 'explore')
    {
        $query = "SELECT imageID,userID,title,caption,stars,timeStamp,fileLocation,privacy,iso,shutterSpeed,fStop,lens,albumID
                    FROM tbpost
                    INNER JOIN tbfollower ON tbpost.userID = tbfollower.userIDFollowing
                    WHERE tbfollower.userIDFollower != ".$_SESSION['userID']." AND privacy ='public'
                    UNION ALL
                    SELECT imageID,userID,title,caption,stars,timeStamp,fileLocation,privacy,iso,shutterSpeed,fStop,lens,albumID
                    FROM tbpost
                    WHERE userID !=  ".$_SESSION['userID']." AND privacy ='public'
                    ORDER BY timeStamp DESC;";

        $infoMsg = "Oooops, Looks like we dont have any global feed to show you.";
        include "./fragments/postsFragment.php";

        $_SESSION['searchValue'] = '';

    }
    if ( isset($_SESSION['searchBy']) && $_SESSION['searchBy'] === 'post')
    {
        $infoMsg = "Oooops, Looks like we could not find the Post with the description ".$_SESSION['searchValue'];
        echo '<div class="heading mt-3">
                <h1>Posts</h1>
            </div>';

        if (isset($_SESSION['searchValue']) && $_SESSION['searchValue'] !== '')
        {
            $query = "SELECT *
            FROM tbpost
            WHERE title LIKE '%".$_SESSION['searchValue']."%' OR  caption LIKE '%".$_SESSION['searchValue']."%' AND privacy = 'public';";

            include "./fragments/postsFragment.php";
        }
        else
        {
            include "./fragments/postsFragment.php";
        }

    }
    if ( isset($_SESSION['searchBy']) && $_SESSION['searchBy'] === 'album')
    {
        $infoMsg = "Oooops, Looks like we could not find the Album with the description ".$_SESSION['searchValue'];
        echo '<div class="heading mt-3">
                <h1>Albums</h1>
            </div>';

        if (isset($_SESSION['searchValue']) && $_SESSION['searchValue'] !== '')
        {
            $query1 = "SELECT *
            FROM tbalbum
            WHERE title LIKE '%".$_SESSION['searchValue']."%' OR  description LIKE '%".$_SESSION['searchValue']."%' AND privacy = 'public';";

            include "./fragments/albumsFragment.php";
        }
        else
        {
            include "./fragments/albumsFragment.php";
        }

    }
    if ( isset($_SESSION['searchBy']) && $_SESSION['searchBy'] === 'user')
    {
        echo '<div class="heading mt-3">
                <h1>Users</h1>
            </div>';

        if (isset($_SESSION['searchValue']) && $_SESSION['searchValue'] !== '')
        {
            $query = "SELECT *
            FROM tbuser
            WHERE name LIKE '%".$_SESSION['searchValue']."%' OR email LIKE '%".$_SESSION['searchValue']."%';";

            $res = $mysqli->query($query);
            if ($res && $res->num_rows > 0)
            {
                echo '<div class="pageContent">';
                echo '<div class="row">';
                while($row = $res->fetch_assoc())
                {
                    echo '<a href="./profile.php?userID='.$row['userID'].'" class="col-lg-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-10 float-left align-self-center text-dark"><h2>'.$row['name'].'</h2><small>'.$row['email'].'</small></div>
                                        <div class="col-2"><img class="float-right" src="../gallery/profilePics/'.$row['profileImage'].'" height="80"></div>
                                    </div>
                                </div>
                            </div>
                        </a>';
                }
                echo '</div>';
                echo '</div>';
            }
            else
            {
                echo '<br/><br/>
                <div class="container" id="infoMsg">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      <strong>'."Oooops, Looks like we could not find the user with the details ".$_SESSION['searchValue'].'</strong>
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
                <div class="container" id="infoMsg">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      <strong>'."Oooops, Looks like we could not find the user with the details ".$_SESSION['searchValue'].'</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </div>';
        }

    }
    else if ( isset($_SESSION['searchBy']) && $_SESSION['searchBy'] === 'hashtag' && !isset($_GET['hashtag']))
    {
        $infoMsg = "Oooops, Looks like no match was found for your search for ".$_SESSION['searchValue'];

        if (isset($_SESSION['searchValue']) && $_SESSION['searchValue'] !== '')
        {
            echo '<div class="heading mt-3">
                    <h1>Posts</h1>
                </div>';

            $query = "SELECT *
            FROM tbpost
            INNER JOIN tbposthashtag on tbpost.imageID = tbposthashtag.imageID
            WHERE tbposthashtag.hashtag LIKE'%".$_SESSION['searchValue']."%' ;";

            include "./fragments/postsFragment.php";

            echo '<div class="heading mt-2">
                    <h1>Albums</h1>
                </div>';

            $query1 = "SELECT *
            FROM tbalbum
            INNER JOIN tbalbumhashtag on tbalbum.albumID = tbalbumhashtag.albumID
            WHERE tbalbumhashtag.hashtag LIKE '%".$_SESSION['searchValue']."%' ;";

            include "./fragments/albumsFragment.php";
        }
        else
        {
            echo '<div class="heading mt-3">
                    <h1>Posts</h1>
                </div>';
            include "./fragments/postsFragment.php";
            echo '<div class="heading mt-2">
                    <h1>Albums</h1>
                </div>';
            include "./fragments/albumsFragment.php";
        }

    }
    else if (isset($_SESSION['searchBy']) && $_SESSION['searchBy'] == 'all' && $_SESSION['searchValue'] !== '')
    {

    }
?>

    <?php include "./fragments/jsLibraries.php"; ?>
    <script src="../js/explore.js"></script>
    <script src="../js/postsFragment.js"></script>
    <script src="../js/albumsFragment.js"></script>
</body>
</html>

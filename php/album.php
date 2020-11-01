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
$albumInfoQuery = "SELECT *
    FROM tbalbum
    WHERE albumID = ".$_GET['albumID'].";";

    $res = $mysqli->query($albumInfoQuery);
    if ($res && $res->num_rows > 0)
    {
        while($row = $res->fetch_assoc())
        {
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
            $getUserQuery = "SELECT *
                            FROM tbalbumhashtag
                            WHERE albumID = ".$_GET['albumID'].";";
            $result = $mysqli->query($getUserQuery);
            if ($result && $result->num_rows > 0)
            {
                while($rowResult = $result->fetch_assoc())
                {
                    echo '<a href="./explore.php?hashtag='.substr($rowResult['hashtag'], 1).'" class="text-secondary">'.$rowResult['hashtag'].'</a>&nbsp;';
                }
            }
           echo '</h3>';
        }
    }
?>


<?php
$query = "SELECT *
    FROM tbpost
    WHERE albumID = ".$_GET['albumID']."
    ORDER BY timeStamp DESC;";

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
                //Edit Album Details
                //Add Friends
                //Delete Album
            }

            //Add Post
            include "./fragments/addPostFragment.php";

            $infoMsg = "Oooops, Looks like you dont have any Posts in this Album. Create your first Posts by clicking the plus in the bottom right";
            include "./fragments/postsFragment.php";
        }
        else if ($viewAccessPublic)
        {
            //Only view Posts
            $infoMsg = "Oooops, Looks like there are no Posts in this Album.";
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


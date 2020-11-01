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
    <link rel="stylesheet" type="text/css" href="../css/feed.css" />
    <link rel="stylesheet" type="text/css" href="../css/postsFragment.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php"; ?>

<div  class="heading">
    <h1>My Activity Feed</h1>
</div>

<?php
$query = "SELECT imageID,userID,title,caption,stars,timeStamp,fileLocation,privacy,iso,shutterSpeed,fStop,lens,albumID
FROM tbpost
INNER JOIN tbfollower ON tbpost.userID = tbfollower.userIDFollowing
WHERE tbfollower.userIDFollower = ".$_SESSION['userID']."
UNION ALL
SELECT imageID,userID,title,caption,stars,timeStamp,fileLocation,privacy,iso,shutterSpeed,fStop,lens,albumID
FROM tbpost
WHERE userID =  ".$_SESSION['userID']."
ORDER BY timeStamp DESC;";

$infoMsg = "Oooops its looking a bit empty here, make sure to follow your favourite photographers to see there posts, or create your very first post in My Posts";

include "./fragments/postsFragment.php";
?>

    <?php include "./fragments/jsLibraries.php"; ?>
    <script src="../js/feed.js"></script>
    <script src="../js/postsFragment.js"></script>
</body>
</html>

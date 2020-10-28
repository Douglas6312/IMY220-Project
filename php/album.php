<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Albums</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php" ?>
    <link rel="stylesheet" type="text/css" href="../css/album.css" />
    <link rel="stylesheet" type="text/css" href="../css/postsFragment.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php" ?>

<div  id="heading">
    <!--TODO When the back arrow is clicked it should go back one place instead of being redirected to the home.php-->
    <h1><a href="albums.php"><i class="fa fa-arrow-left leftArrow" aria-hidden="true"></i></a> Hockey Album</h1>
</div>

<?php include "./fragments/postsFragment.php" ?>

    <?php include "./fragments/jsLibraries.php" ?>
    <script src="../js/album.js"></script>
    <script src="../js/postsFragment.js"></script>
</body>
</html>


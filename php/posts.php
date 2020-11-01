<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Posts</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php"; ?>
    <link rel="stylesheet" type="text/css" href="../css/posts.css" />
    <link rel="stylesheet" type="text/css" href="../css/postsFragment.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php"; ?>

<div  class="heading">
    <h1>My Posts</h1>
</div>

<?php

    $query = "SELECT *
    FROM tbpost
    WHERE userID = ".$_SESSION["userID"]."
    ORDER BY timeStamp DESC ;";

    $infoMsg = "Oooops, Looks like you dont have any Posts. Create your first Posts by clicking the plus in the bottom right";
    include "./fragments/postsFragment.php";
?>

<?php include "./fragments/addPostFragment.php"; ?>


    <?php include "./fragments/jsLibraries.php"; ?>
    <script src="../js/posts.js"></script>
    <script src="../js/postsFragment.js"></script>
</body>
</html>

<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php" ?>
    <link rel="stylesheet" type="text/css" href="../css/myFeed.css" />
    <link rel="stylesheet" type="text/css" href="../css/postsFragment.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php" ?>


<div  id="heading">
    <h1>My Activity Feed</h1>
</div>

<!--TODO having loading symbol while the main content (My Feed) get populated from tge DB and js-->
<?php include "./fragments/postsFragment.php" ?>

    <?php include "./fragments/jsLibraries.php" ?>
    <script src="../js/myFeed.js"></script>
    <script src="../js/postsFragment.js"></script>
</body>
</html>

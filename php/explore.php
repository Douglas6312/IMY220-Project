<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Explore</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php" ?>
    <link rel="stylesheet" type="text/css" href="../css/explore.css" />
    <link rel="stylesheet" type="text/css" href="../css/postsFragment.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php" ?>

<div  id="heading">
    <h1>Explore</h1>
</div>


<?php include "./fragments/postsFragment.php" ?>

    <?php include "./fragments/jsLibraries.php" ?>
    <script src="../js/explore.js"></script>
    <script src="../js/postsFragment.js"></script>
</body>
</html>

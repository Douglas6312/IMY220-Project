<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php" ?>
    <link rel="stylesheet" type="text/css" href="../css/myProfile.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php" ?>

<!--TODO functionality where admins can manage and edit all the necessary things they need to !!!!! -->

<div  id="heading">
    <h1> My Profile</h1>
</div>

<!--TODO Display to the user their userID and any other useful information...-->
<!--TODO Look at Asg4 of how to edit the details in a nice modern way !!!!!!!!!!!-->
<!--TODO Show followers, followong, as well as all my individual posts !! (Like Instagram)-->

<main id="settings">
    <div class="row">
        <div class="col-3"> <img class="mr-3 rounded-circle" alt="avatar" height="300" src="../assets/default.png" /></div>
        <div class="col-4">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div data-type="text" class="details mb-3">
                            <b>Name:</b> <span>Dipper</span> <button class="btn btn-dark pull-right">Edit</button>
                        </div>
                        <div data-type="email" class="details mb-3">
                            <b>Email:</b> <span>dipper@gmail.com</span> <button class="btn btn-dark pull-right">Edit</button>
                        </div>
                        <div data-type="date" class="details mb-3">
                            <b>Birth date:</b> <span>13 April 2006</span> <button class="btn btn-dark pull-right">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    <?php include "./fragments/jsLibraries.php" ?>
    <script src="../js/myProfile.js"></script>
</body>
</html>


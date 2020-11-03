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
</head>
<body>

<?php include "./fragments/navbarFragment.php"; ?>


<div  class="heading">
    <h1> My Profile</h1>
</div>

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

    <?php include "./fragments/jsLibraries.php"; ?>
    <script src="../js/profile.js"></script>
</body>
</html>


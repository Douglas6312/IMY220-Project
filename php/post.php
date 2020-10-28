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
    <link rel="stylesheet" type="text/css" href="../css/post.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php" ?>

<div  id="heading">
    <!--TODO add a back arrow here to go bach to the feed...-->
    <h1><a href="#" id="goBack"><i class="fa fa-arrow-left leftArrow" aria-hidden="true"></i></a> Post</h1>
</div>

<!--TODO add functionality to:  -->
<!--TODO Report Post (with  a dropdown list of reasons ) (which can be edited by admins...) -->
<!--TODO have three dots in conner then it expands to options where you then can report, add to album etc....-->
<!--TODO maybe re-order the info so that the likes, comments and report is similar to Instagram NB!!!!!!!!! -->
<!--TODO Add it to an album  -->
<!--TODO Refine my design etc... -->

<main id="myFeed" class="container-fluid">
    <div class="row">
        <img src="../gallery/mountainskies.jpg" class="col-8">
        <div class="col-4">
            <div><h1>Title: <b>MountainSkies</b></h1></div>
            <div><h1>By: <a href="#" data-userID="1234">Douglas</a></h1></div>
            <div><h1><b>6312</b><i class="fa fa-star-o fa-1x" aria-hidden="true"></i></h1></div>
            <div><h1>Tags: <h3>#mountain #beauty #talent #passion</h3></h1></div>
        </div>
    </div>

    <br>

    <h3 class="mb-3"> <i class="fa fa-comment-o" aria-hidden="true"></i> Comments </h3>
    <div class="row">
        <div class="mb-1 mt-1">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">

                                <div class="media mb-2">
                                    <img class="mr-3 rounded-circle" alt="avatar" src="../assets/default.png" />
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-8 d-flex">
                                                <h5>George Russel</h5>
                                            </div>
                                        </div> Fantastic Photo wish i could be there
                                    </div>
                                </div>

                                <div class="media mb-2">
                                    <img class="mr-3 rounded-circle" alt="avatar" src="../assets/default.png" />
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-8 d-flex">
                                                <h5>Will Smith</h5>
                                            </div>
                                        </div> Wooooowwwwwww
                                    </div>
                                </div>

                                <div class="media mb-2">
                                    <img class="mr-3 rounded-circle" alt="avatar" src="../assets/default.png" />
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-8 d-flex">
                                                <h5>Iron Man</h5>
                                            </div>
                                        </div> Perfect place for retirement
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>


    <?php include "./fragments/jsLibraries.php" ?>
    <script src="../js/post.js"></script>
</body>
</html>

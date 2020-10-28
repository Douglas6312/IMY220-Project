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
    <link rel="stylesheet" type="text/css" href="../css/albums.css" />
    <link rel="stylesheet" type="text/css" href="../css/albumsFragment.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php" ?>

<div  id="heading">
    <h1>My Albums</h1>
</div>

<!--TODO having loading symbol while the main content (My Feed) get populated from tge DB and js-->
<!--TODO clearly show how you can edit a album and add new friends and change the details-->
<!--TODO the user who created the album is only able to edit the album -->
<!--TODO clearly show some how if the album is a shared album with friends  -->
<!--TODO Or whether it is a personal one  -->
<!--TODO Also display weather it is public or private  -->
<!--TODO Cover page should describe the album and have a pic of the first pic in that album as its cover page...  -->
<!--TODO NB!!!! First create the Album the you can give friends access after it has been created.. (add one at a time...)  -->

<?php include "./fragments/albumsFragment.php" ?>

<section id="newAlbum">
    <a class="fab" data-toggle="modal" data-target="#newAlbum_View"> + </a>
</section>

<div class="modal fade product_view" id="newAlbum_View">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">New Album</h3>
                <a href="#" data-dismiss="modal" class="class pull-right"><i class="fa fa-remove fa-2x"></i></a>
            </div>
            <div class="modal-body">
                <div class="container">
                    <section id="forms" >
                        <div class="col-12">
                            <div class="card">
                                <form method="POST" action="#"> <!--action="./php/albun.php"-->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <label for="regName">Name:</label>
                                                <input type="text" id="regName" class="form-control" placeholder="favourites" name="regName" autocomplete="off" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="regDescription">Description:</label>
                                                <input type="text" id="regDescription" class="form-control" placeholder="Describe your collection" name="regDescription" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1"><i class="fa fa-lock" aria-hidden="true"></i> Private</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" checked>
                                                    <label class="form-check-label" for="inlineRadio2"><i class="fa fa-unlock" aria-hidden="true"></i> Public</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <button type="submit" id="registerBtn" class="btn btn-dark submitButton">Create <i class="fa fa-angle-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                </section>
            </div>
        </div>
    </div>
</div>

    <?php include "./fragments/jsLibraries.php" ?>
    <script src="../js/albums.js"></script>
    <script src="../js/albumsFragment.js"></script>
</body>
</html>


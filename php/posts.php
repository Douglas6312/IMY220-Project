<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Posts</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php" ?>
    <link rel="stylesheet" type="text/css" href="../css/posts.css" />
    <link rel="stylesheet" type="text/css" href="../css/postsFragment.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php" ?>

<div  id="heading">
    <h1>My Posts</h1>
</div>

<?php include "./fragments/postsFragment.php" ?>

<section id="newPost">
    <a class="fab" id="newFab" data-toggle="modal" data-target="#newPost_View"> + </a>
</section>

<div class="modal fade product_view" id="newPost_View">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">New Post</h3>
                <a href="#" data-dismiss="modal" class="class pull-right"><i class="fa fa-remove fa-2x"></i></a>
            </div>
            <div class="modal-body">
                <div class="container">
                    <section id="forms">
                        <div class="col-12">
                            <div class="card">
                                <form method="POST" action="#" > <!--action="./php/home.php"-->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <label for="regTitle">Title:</label>
                                                <input type="text" id="regTitle" class="form-control" placeholder="A dash of life" name="regTitle" autocomplete="off" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="regCaption">Caption:</label>
                                                <input type="text" id="regCaption" class="form-control" placeholder="The story of my life" name="regCaption" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-lg-6">
                                                <label for="regHashtags">Hashtags:</label>
                                                <input type="text" id="regHashtags" class="form-control" placeholder="#awesome #YOLO #LOL" name="regHashtags" autocomplete="off" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="regPicture">Picture:</label>
                                                <input type="file" id="regPicture" class="form-control" name="regPicture" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="form-row col-12">
                                                <div class="col-3">
                                                    <small class="form-text text-muted mb-1">ISO</small>
                                                    <label class="sr-only"  for="regISO">
                                                    </label><input type="text" class="form-control" id="regISO" placeholder="100" autocomplete="off" required>
                                                </div>
                                                <div class="col-3">
                                                    <small class="form-text text-muted mb-1">Shutter</small>
                                                    <label class="sr-only"  for="regShutter"></label>
                                                    <input type="text" class="form-control" id="regShutter" placeholder="1/200" autocomplete="off" required>
                                                </div>
                                                <div class="col-3">
                                                    <small class="form-text text-muted mb-1">&fnof; Stop</small>
                                                    <label class="sr-only"  for="regFStop"></label>
                                                    <input type="text" class="form-control" id="regFStop" placeholder="&fnof;2.8" autocomplete="off" required>
                                                </div>
                                                <div class="col-3">
                                                    <small class="form-text text-muted mb-1">Lens</small>
                                                    <label class="sr-only"  for="regLens"></label>
                                                    <input type="text" class="form-control" id="regLens" placeholder="200mm" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 m-3 text-center" id="pImg"><img id="previewImg"></div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <button type="submit" id="registerBtn" class="btn btn-dark submitButton">Post <i class="fa fa-angle-right"></i></button>
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
    <script src="../js/posts.js"></script>
    <script src="../js/postsFragment.js"></script>
</body>
</html>

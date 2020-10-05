<?php

include "./globals.php";

//TODO cant get PHP sessions to work...
/*if(isset($_SESSION["userID"]))
{
    header("Location:../index.php");
    exit();
}*/

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">

    <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <link rel="stylesheet" type="text/css" href="../css/home.css" />
</head>
<body>

<!--TODO Need to add another nav option for viewing and sending messages !!!! -->
<!--TODO Clearly display of the user is an admin user... -->
<!--TODO Make sure to include and implement to logout functionality in all files (deleting all the DOM cookies etc...) -->
<!--TODO Implement an infinite scroll !!!!!!! (Likw the one assignment...)-->


<header id="topHeader" class="fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-lg-0">

            <a class="navbar-brand ml-2" href="./home.php">
                <h1 class="logo"><img src="../assets/logo1.png" alt="logo" class="img-fluid">PhotoFrames</h1>
            </a>

            <button class="navbar-toggler" type="button"
                    data-toggle="collapse"
                    data-target="#navbarResponsive"
                    aria-controls="navbarResponsive"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto mr-auto">
                    <li class="nav-item mx-1 active activeLine"><a class="nav-link" href="./home.php">My Feed</a></li>
                    <li class="nav-item mx-1"><a class="nav-link" href="#">Explore</a></li>
                    <li class="nav-item mx-1"><a class="nav-link" href="./album.php">My Albums</a></li>
                </ul>
                <ul class="navbar-nav float-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">My Profile</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="./profile.php">View Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="logout" href="../index.php">Logout</a>
                        </div>
                    </li>
                </ul>
                <img src="../assets/default.png" alt="Avatar" class="avatar mr-2">
            </div>

        </nav>
    </div>
</header>


<div  id="heading">
    <h1>My Activity Feed</h1>
</div>


<!--TODO having loading symbol while the main content (My Feed) get populated from tge DB and js-->
<!--TODO When user clicks on the image it takes them to the post view to show all details regarding img at full size...-->

<main id="myFeed" class="container-fluid">
    <div class="row">
        <div class="column">
            <div class="img" data-postID="1234">
                <img src="../gallery/wedding.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/rocks.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/falls2.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/paris.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/nature.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/mist.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/paris.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="img" data-postID="1234">
                <img src="../gallery/underwater.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/ocean.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/wedding.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/mountainskies.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/rocks.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/underwater.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="img" data-postID="1234">
                <img src="../gallery/wedding.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/rocks.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/falls2.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/paris.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/nature.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/mist.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/paris.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="img" data-postID="1234">
                <img src="../gallery/underwater.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/ocean.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/wedding.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/mountainskies.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/rocks.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
            <div class="img" data-postID="1234">
                <img src="../gallery/underwater.jpg" class="image" alt="imgGoesHere">
                <div class="middle">
                    <div class="text">Image <a href="#">Title</a></div>
                    <div class="text">By <a href="#" data-userID="1234">Douglas</a></div>
                    <div class="text"><i class="fa fa-star-o" aria-hidden="true"></i> Likes/Stars</div>
                    <div class="text"># HashTags</div>
                    <div class="text"><i class="fa fa-comment-o" aria-hidden="true"></i> Recent Comments</div>
                </div>
            </div>
        </div>

    </div>
</main>

<section id="newPost">
    <a class="fab" data-toggle="modal" data-target="#newPost_View"> + </a>
</section>

<!--TODO must still implement it to be able to upload to the server -->
<!--TODO remember to be able to change the permissions of the galary folder in file zilla-->
<!--TODO make sure to do all the necessary error checks and sanitization with proper rules and error checking... -->

<div class="modal fade product_view" id="newPost_View">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">New Post</h3>
                <a href="#" data-dismiss="modal" class="class pull-right"><i class="fa fa-remove fa-2x"></i></a>
            </div>
            <div class="modal-body">
                <div class="container">
                    <section id="forms" >
                        <div class="col-12">
                            <div class="card">
                                <form method="POST" action="#" > <!--action="./php/home.php"-->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <label for="regName">Name:</label>
                                                <input type="text" id="regName" class="form-control" placeholder="A dash of life" name="regName" autocomplete="off" required>
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



    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../js/home.js"></script>
</body>
</html>

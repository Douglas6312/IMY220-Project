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
    <link rel="stylesheet" type="text/css" href="../css/viewAlbum.css" />
</head>
<body>

<header id="topHeader" class="fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <nav class=" navbar navbar-expand-lg navbar-light fixed-top py-lg-0">

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
                    <li class="nav-item mx-1"><a class="nav-link" href="./home.php">My Feed</a></li>
                    <li class="nav-item mx-1"><a class="nav-link" href="#">Explore</a></li>
                    <li class="nav-item mx-1 active activeLine"><a class="nav-link" href="./album.php">My Albums</a></li>
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
    <!--TODO When the back arrow is clicked it should go back one place instead of being redirected to the home.php-->
    <h1><a href="./album.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Hockey Album</h1>
</div>

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
        </div>

    </div>
</main>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../js/viewAlbum.js"></script>
</body>
</html>


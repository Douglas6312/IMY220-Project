<?php
session_start();
session_unset();
session_destroy();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">

    <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css" />

    <!-- TODO create a fall back for CND libraries if CND dont load.... -->

</head>
<body>

<header id="topHeader" class="fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">
                <h1 class="logo"><a href="./index.php"><img src="assets/logo1.png" alt="logo" class="img-fluid"></a>PhotoFrames</h1>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                </ul>
            </div>
        </nav>
    </div>
</header>

<section id="splash" class="d-flex align-items-center"> <!--TODO have main image cycle between top user post-->
    <div class="row col-12">
        <div class="container d-flex flex-column align-items-center" id="splashInfo" data-aos="zoom-in" data-aos-delay="100">
            <h1 class="my-4">Where your talent Thrives</h1>
            <h2 class="my-1">A Social Media designed for Photographers by Photographers</h2>
            <div class="row">
                <a href="#" class="btnLink mr-2" data-toggle="modal" data-target="#register_view">Sign up</a>
                <a href="#" class="btnLink ml-2" data-toggle="modal" data-target="#login_view">Login</a>
            </div>
        </div>
    </div>
</section>

<footer id="AdditionalFooterInfo">
    <div class="container-fluid mt-5 bg-text">
        <h4 class="display-4 text-left"><b>Why Choose PHOTOFRAMES</b></h4>
        <br>
        <ul>
            <li><h1 class="text-left"><b>Showcase your talent to the world</b></h1></li>
            <li><h1 class="text-left"><b>Share your passion with like minded people</b></h1></li>
            <li><h1 class="text-left"><b>Photography is met to be shared</b></h1></li>
            <li><h1 class="text-left"><b>Collaborate and share with local photographers</b></h1></li>
            <li><h1 class="text-left"><b>Build your online portfolio</b></h1></li>
            <li><h1 class="text-left"><b>Easily share and organise your memories</b></h1></li>
            <li><h1 class="text-left"><b>Just be cool</b></h1></li>
        </ul>
    </div>

</footer>

<div class="modal fade product_view" id="login_view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Login</h3>
                <a href="#" data-dismiss="modal" class="class pull-right"><i class="fa fa-remove fa-2x"></i></a>
            </div>
            <div class="modal-body">
                <div class="container">
                    <section id="forms">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <form method="POST" action="./php/myFeed.php" id="loginForm">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-lg-6">
                                                    <label for="loginEmail">Email Address:</label>
                                                    <input type="email" id="loginEmail" class="form-control" placeholder="name@email.com" name="loginEmail" autocomplete="off" required>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="loginPass">Password:</label>
                                                    <input type="password" id="loginPass" class="form-control" placeholder="******" name="loginPass" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <button type="submit" id="loginBtn" class="btn btn-dark submitButton">Login <i class="fa fa-angle-right"></i></button>
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
</div>


<div class="modal fade product_view" id="register_view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Register</h3>
                <a href="#" data-dismiss="modal" class="class pull-right"><i class="fa fa-remove fa-2x"></i></a>
            </div>
            <div class="modal-body">
                <div class="container">
                    <section id="forms" >
                            <div class="col-12">
                                <div class="card">
                                    <form method="POST" action="./php/myFeed.php" id="registerForm">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-lg-6">
                                                    <label for="regName">Name:</label>
                                                    <input type="text" id="regName" class="form-control" placeholder="John" name="regName" autocomplete="off" required>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="regBio">Bio:</label>
                                                    <input type="text" id="regBio" class="form-control" placeholder="Tell us something about yourself" name="regBio" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-lg-6">
                                                    <label for="regEmail">Email Address:</label>
                                                    <input type="email" id="regEmail" class="form-control" placeholder="john.doe@gmail.com" name="regEmail" autocomplete="off" required>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="regBirthDate">Date of Birth:</label>
                                                    <input type="date" id="regBirthDate" class="form-control" name="regBirthDate" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-lg-6">
                                                    <label for="regEmail">Create Password:</label>
                                                    <input type="password" id="pass1" class="form-control" placeholder="******" name="regPass" autocomplete="off" required>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="regEmail">Confirm Password:</label>
                                                    <input type="password" id="pass2" class="form-control" placeholder="******" name="regConfirmPass" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <button type="submit" id="registerBtn" class="btn btn-dark submitButton">Register <i class="fa fa-angle-right"></i></button>
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
    <script src="js/registerLoginLogout.js"></script>
</body>
</html>

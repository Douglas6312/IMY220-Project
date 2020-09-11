<?php
// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$server = "localhost";
$username = "u19049782";
$password = "ivypudta";
$database = "dbu19049782";
$mysqli = mysqli_connect($server, $username, $password, $database);

$email = isset($_POST["loginEmail"]) ? $_POST["loginEmail"] : false;
$pass = isset($_POST["loginPass"]) ? $_POST["loginPass"] : false;
// if email and/or pass POST values are set, set the variables to those values, otherwise make them false
?>

<!DOCTYPE html>
<html>
<head>
    <title>IMY 220 - Assignment 2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <!-- Replace Name Surname with your name and surname -->
</head>
<body>

<header id="topHeader" class="fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">
                <h1 class="logo"><img src="../img/logo1.png" alt="logo" class="img-fluid">PhotoFrames</h1>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">explore</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Feed</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Global Feed</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<section id="splash" class="d-flex align-items-center">
    <div class="row col-12">
        <div class="container d-flex flex-column align-items-center" id="splashInfo" data-aos="zoom-in" data-aos-delay="100">


                <div class="container">
                <?php
                if($email && $pass)
                {
                    $query = "SELECT * FROM tbusers WHERE email = '$email' AND password = '$pass'";
                    $res = $mysqli->query($query);
                    if($row = mysqli_fetch_array($res))
                    {
                        $UserID = $row['user_id'];
                        echo'';
                    }
                    else
                    {
                        echo 	'<h1 class="display-1 text-center text-danger">OOPS SOMETHING WENT WRONG, PLEASE TRY AGAIN LATER </h1>
                               <a class="btn btn-secondary" href="../index.php"><h4><i class="fa fa-home fa-2x"></i> Return Home</h4></a>';
                    }
                }
                else
                {
                    echo 	'<h1 class="display-1 text-center text-danger">OOPS SOMETHING WENT WRONG, PLEASE TRY AGAIN LATER </h1>
                               <a class="btn btn-secondary" href="../index.php"><h4><i class="fa fa-home fa-2x"></i> Return Home</h4></a>';
                }
                ?>

                    <div class="row">
                        <div class="col-4 mb-4">
                            <div class="card">
                                <img class="card-img-top" src="../img/pic2.jpeg">
                                <div class="card-body">
                                    <h6 class="card-title"><b>Name</b></h6>
                                    <p class="card-text m-0"><b>Description <span class="text-primary">My First Photo...</span></b></p>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text m-0"><b>Tags <span class="text-primary">#first #road #best</span></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mb-4">
                            <div class="card">
                                <img class="card-img-top" src="../img/pic2.jpeg">
                                <div class="card-body">
                                    <h6 class="card-title"><b>Name</b></h6>
                                    <p class="card-text m-0"><b>Description <span class="text-primary">My First Photo...</span></b></p>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text m-0"><b>Tags <span class="text-primary">#first #road #best</span></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mb-4">
                            <div class="card">
                                <img class="card-img-top" src="../img/pic2.jpeg">
                                <div class="card-body">
                                    <h6 class="card-title"><b>Name</b></h6>
                                    <p class="card-text m-0"><b>Description <span class="text-primary">My First Photo...</span></b></p>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text m-0"><b>Tags <span class="text-primary">#first #road #best</span></b></p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
    <!--More content Will go Here promoting website and Other stuff-->
</section>



</body>
</html>
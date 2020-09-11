<?php
// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$server = "localhost";
$username = "u19049782";
$password = "ivypudta";
$database = "dbu19049782";
$mysqli = mysqli_connect($server, $username, $password, $database);

$name = $_POST["regName"];
$surname = $_POST["regSurname"];
$email = $_POST["regEmail"];
$date = $_POST["regBirthDate"];
$pass = $_POST["regPass"];

$query = "INSERT INTO tbusers (name, surname, email, birthday, password) VALUES ('$name', '$surname', '$email', '$date', '$pass');";

$res = mysqli_query($mysqli, $query) == TRUE;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>IMY 220 - Assignment 2</title>
    <meta name="author" content="Douglas van Reeuwyk">
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <footer id="welcomeMessage">
        <div class="container-fluid">
            <?php
            if($res)
                echo '<h1 class="display-1 text-left">WELCOME <a class="btn btn-secondary pull-right" href="../index.php"><h4><i class="fa fa-home fa-2x"></i> Return Home to Login</h4></a></h1>';
            else
                echo '<h1 class="display-1 text-left text-danger">OOPS SOMETHING WENT WRONG, PLEASE TRY AGAIN LATER <a class="btn btn-secondary pull-right" href="../index.php"><h4><i class="fa fa-home fa-2x"></i> Return Home to Login</h4></a></h1>';
            ?>
        </div>
    </footer>
</body>
</html>
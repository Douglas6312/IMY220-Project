<?php
session_start();
if(!isset($_SESSION['userID']))
{
    session_unset();
    session_destroy();
    header("Location:../index.php");
}

// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$server = "localhost";
$username = "root"; //u19049782
$password = ""; //ivypudta
$database = "dbu19049782";
$mysqli = new mysqli($server, $username, $password, $database);

if ($mysqli->connect_errno)
{
    $data = array("msg"=>"Failed to connect to MySQL" . $mysqli->connect_error);
    $json = json_encode($data);
    die($json);
}

$userID = $_SESSION["userID"];
$numUnreadMessages = "";
$query = "SELECT * FROM tbmessage WHERE receiverUserID = '$userID' AND hasRead = false";
$res = $mysqli->query($query);
if ($res && $res->num_rows > 0)
{
    $numUnreadMessages = $res->num_rows;
}

//TODO make sure to close the connection once done... (where would i do this ???) $mysqli->close();

//TODO make a globals for the userID when they log in

//TODO MUST have the session_start() on each PHP page on the first line !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//TODO follow and add friend are two different things !!!!!!!!!!!
//TODO Add functionality that when i select a photo it displays selected picture using JQuery
//TODO at top of the nav bar have icons where i show if i have a new notification or a new message
//TODO nav bar also show if the user is admin user
//TODO have a loading screen when lading content etc... (toggle a CSS class)
//TODO make sure that it works on the IMY server
//TODO Fix my register feature...

//TODO when using bootstrap alert/ warning for user errors put cross for option for user to close the error
//TODO also change the default color of the alert to the websites color scheme...

//TODO show more photography information on pictures, like the ISO,Shutter speed, White Balance and other information !!!!!!!!!!!!!!!!!!!!!!!!

//TODO consider making an API that interfaces with my DB (Like COS216) NB!!!!!!!!!!!!!!

//TODO make sure to change the file permissions inside filezilla so that i can upload images....

?>
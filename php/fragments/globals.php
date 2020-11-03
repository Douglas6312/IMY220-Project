<?php
session_start();

//Security and logout features and checks
if(!isset($_SESSION['userID']) || (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)))// last request was more than 30 minutes ago
{
    session_unset();
    session_destroy();
    $mysqli->close();
    header("Location:../index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();
if (time() - $_SESSION['CREATED'] > 1200)
{
    // change session ID for the current session and invalidate old session ID, to stop session fixation attacks
    session_regenerate_id(true);
    $_SESSION['CREATED'] = time();  // update creation time
}

// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

//Database connection settings and connection
$server = "localhost";
$username = "root"; //u19049782
$password = ""; //ivypudta
$database = "dbu19049782";
$mysqli = new mysqli($server, $username, $password, $database);

//if ($mysqli->ping()) {
//    printf ("Our connection is ok!\n");
//} else {
//    printf ("Error: %s\n", $mysqli->error);
//}

if ($mysqli->connect_errno)
{
    $data = array("msg"=>"Failed to connect to MySQL" . $mysqli->connect_error);
    $json = json_encode($data);
    die($json);
}

//load notifications if the user has unread messages
$userID = $_SESSION["userID"];
$numUnreadMessages = "";
$query = "SELECT * FROM tbmessage WHERE receiverUserID = '$userID' AND hasRead = false";
$res = $mysqli->query($query);
if ($res && $res->num_rows > 0)
{
    $numUnreadMessages = $res->num_rows;
}

//validate all input added into the Database...
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
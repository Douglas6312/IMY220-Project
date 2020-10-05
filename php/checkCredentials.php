<?php

include "./globals.php";

//TODO make sure to close the connection once done... $mysqli->close();

if ($mysqli->connect_errno)
{
    $data = array("msg"=>"Valid", "userID"=>"Connection failed: " . $mysqli->connect_error);
    $json = json_encode($data);
    die($json);
}

$email = isset($_POST["email"]) ? $_POST["email"] : false;
$pass = isset($_POST["pass"]) ? $_POST["pass"] : false;

if ($email && $pass)
{
    $query = "SELECT * FROM tbuser WHERE email = '$email' AND password = '$pass'";
    $res = $mysqli->query($query);

    if ($row = mysqli_fetch_array($res))
    {
        $userID = $row['userID'];
        $name = $row['name'];
        $profileImage = $row['profileImage'];

        $data = array("msg"=>"Valid", "userID"=>$userID, "name"=>$name, "profileImage"=>$profileImage);
        $json = json_encode($data);
        die($json);

        //TODO cant get PHP sessions to work...
        /*session_start();
        if(!isset($_SESSION["userID"]))
        {
            $_SESSION["userID"] = $UserID;
        }*/
    }
    else
    {
        $data = array("msg"=>"Password and/or username is incorrect");
        $json = json_encode($data);
        die($json);
    }
}
else
{
    /*$data = array("msg"=>"Please Enter all details as required");
    $json = json_encode($data);
    die($json);*/
}

//TODO do a check to see if the email does not already exist

$name = isset($_POST["name"]) ? $_POST["name"] : false;
$bio = isset($_POST["bio"]) ? $_POST["bio"] : false;
$email = isset($_POST["email"]) ? $_POST["email"] : false;
$dob = isset($_POST["dob"]) ? $_POST["dob"] : false;
$pass1 = isset($_POST["pass1"]) ? $_POST["pass1"] : false;


if ($name && $bio && $email && $dob && $pass1)
{
    $query = "INSERT INTO tbuser (name, email, dateOfBirth, bio, password) VALUES ('$name', '$email', '$dob', '$bio', '$pass1');";
    $res = mysqli_query($mysqli, $query) == TRUE;

    if ($res)
    {
        $query = "SELECT * FROM tbuser WHERE email = '$email' AND password = '$pass'";
        $res = $mysqli->query($query);

        if ($row = mysqli_fetch_array($res))
        {
            $userID = $row['userID'];
            $name = $row['name'];
            $profileImage = $row['profileImage'];

            $data = array("msg"=>"Valid", "userID"=>$userID, "name"=>$name, "profileImage"=>$profileImage);
            $json = json_encode($data);
            die($json);
        }
        else
        {
            $data = array("msg"=>"!!! An unexpected error occurred, please try again later");
            $json = json_encode($data);
            die($json);
        }
    }
    else
    {
        $data = array("msg"=>"!!! An unexpected error occurred, please try again later");
        $json = json_encode($data);
        die($json);
    }
}
else
{
    /*$data = array("msg"=>"Please Enter all details as required");
    $json = json_encode($data);
    die($json);*/
}

?>
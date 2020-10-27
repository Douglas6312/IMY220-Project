<?php
session_start();

// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$server = "localhost";
$username = "root"; //u19049782
$password = ""; //ivypudta
$database = "dbu19049782";
$mysqli = new mysqli($server, $username, $password, $database);

$logEmail = test_input(isset($_POST["logEmail"]) ? $_POST["logEmail"] : false);
$logPass = test_input(isset($_POST["logPass"]) ? $_POST["logPass"] : false);

$regName = test_input(isset($_POST["regName"]) ? $_POST["regName"] : false);
$regBio = test_input(isset($_POST["regBio"]) ? $_POST["regBio"] : false);
$regEmail = test_input(isset($_POST["regEmail"]) ? $_POST["regEmail"] : false);
$regDob = test_input(isset($_POST["regDob"]) ? $_POST["regDob"] : false);
$regPass1 = test_input(isset($_POST["regPass1"]) ? $_POST["regPass1"] : false);

sleep(1);

if(!$mysqli->connect_errno) //check if the connection to the DB was successful
{
    if ($regName && $regBio && $regEmail && $regDob && $regPass1)
    {
        $isUniqueEmail = false;

        //$stmt = $mysqli->prepare("SELECT * FROM tbuser WHERE email = ? ");
        //$stmt->bind_param("s", $regEmail);
        //$res = $stmt->execute();

        $query = "SELECT * FROM tbuser WHERE email = '$regEmail'";
        $res = $mysqli->query($query);

        if ($res && !$res->num_rows > 0)
        {
            $isUniqueEmail = true;
        }

        if ($isUniqueEmail)
        {
            $regPass1 = password_hash($regPass1, PASSWORD_DEFAULT);//hash password

            $query = "INSERT INTO tbuser (name, email, dateOfBirth, bio, password) VALUES ('$regName', '$regEmail', '$regDob', '$regBio', '$regPass1');";
            $res = $mysqli->query($query);

            if ($res)
            {
                $query = "SELECT * FROM tbuser WHERE email = '$regEmail' AND password = '$regPass1'";
                $res = $mysqli->query($query);

                if ($res && $res->num_rows > 0)
                {
                    $row = mysqli_fetch_array($res);

                    $userID = $row['userID'];
                    $name = $row['name'];
                    $profileImage = $row['profileImage'];
                    $userType = $row['userType'];

                    $data = array("msg"=>"Valid", "userID"=>$userID, "name"=>$name, "profileImage"=>$profileImage);
                    $json = json_encode($data);

                    $_SESSION['userID'] = $userID;
                    $_SESSION['userName'] = $name;
                    $_SESSION['userProfileImg'] = $profileImage;
                    $_SESSION['userType'] = $userType;

                    $mysqli->close();
                    echo $json;
                }
                else
                {
                    $data = array("msg"=>"!!! An unexpected error occurred, please try again later, ". mysqli_error($mysqli));
                    $json = json_encode($data);
                    $mysqli->close();
                    echo $json;
                }
            }
            else
            {
                $data = array("msg"=>"!!! An unexpected error occurred, please try again later, " . mysqli_error($mysqli));
                $json = json_encode($data);
                $mysqli->close();
                echo $json;
            }
        }
        else
        {
            $data = array("msg"=>"This email address already has an account, " . mysqli_error($mysqli));
            $json = json_encode($data);
            $mysqli->close();
            echo $json;
        }
    }
    else if ($logEmail && $logPass)
    {
        $passwordMatches = false;

        $query = "SELECT * FROM tbuser WHERE email = '$logEmail'";
        $res = $mysqli->query($query);
        $row = mysqli_fetch_array($res);

        if ($res->num_rows > 0 && password_verify($logPass,  $row['password'] ))
        {
            $passwordMatches = true;
        }

        if ($passwordMatches)
        {
            if ($res && $res->num_rows > 0)
            {
                $userID = $row['userID'];
                $name = $row['name'];
                $profileImage = $row['profileImage'];
                $userType = $row['userType'];

                $data = array("msg"=>"Valid", "userID"=>$userID, "name"=>$name, "profileImage"=>$profileImage);
                $json = json_encode($data);

                $_SESSION['userID'] = $userID;
                $_SESSION['userName'] = $name;
                $_SESSION['userProfileImg'] = $profileImage;
                $_SESSION['userType'] = $userType;

                $mysqli->close();
                echo $json;

            }
            else
            {
                $data = array("msg"=>"!!! An unexpected error occurred, please try again later, " . mysqli_error($mysqli));
                $json = json_encode($data);
                $mysqli->close();
                echo $json;
            }
        }
        else
        {
            $data = array("msg"=>"Password and/or username is incorrect, " . mysqli_error($mysqli));
            $json = json_encode($data);
            $mysqli->close();
            echo $json;
        }

    }
    else
    {
        $data = array("msg"=>"Please Enter all details as required, " . mysqli_error($mysqli));
        $json = json_encode($data);
        $mysqli->close();
        echo $json;
    }
}
else
{
    $data = array("msg"=>"Failed to connect to MySQL" . $mysqli->connect_error);
    $json = json_encode($data);
    $mysqli->close();
    echo $json;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
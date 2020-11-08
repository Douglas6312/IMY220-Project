<?php

include "./globals.php";

if (isset($_POST['action']))
{
    if ($_POST['action'] == "deleteAlbum")   //need to add cascading deletes in here for foreign keys !!!
    {
        if (isset($_POST['albumID']))
        {
            $filesRemoved = true;

            $query = "SELECT *
                    FROM tbpost
                    WHERE albumID = ".$_POST['albumID'];

            $res = $mysqli->query($query);
            if ($res && $res->num_rows > 0)
            {
                while ($row = $res->fetch_assoc())
                {
                    $file_pointer = "../".$row['fileLocation'];

                    if (!unlink($file_pointer))
                    {
                        //Could not delete file
                        $filesRemoved = false;
                        $data = array("msg"=>"Invalid");
                        $json = json_encode($data);
                        echo $json;
                    }
                }
            }

            if ($filesRemoved)
            {
                $query = "DELETE
                    FROM tbpost
                    WHERE albumID = ".$_POST['albumID'];

                $res = $mysqli->query($query);
                if (!$res)
                {
                    $filesRemoved = false;
                    $data = array("msg"=>"Invalid");
                    $json = json_encode($data);
                    echo $json;
                }

            }

            if ($filesRemoved)
            {
                $query = "DELETE
                    FROM tbalbum
                    WHERE albumID = ".$_POST['albumID'];

                $res = $mysqli->query($query);
                if ($res)
                {
                    $data = array("msg"=>"Valid");
                    $json = json_encode($data);
                    echo $json;
                }
                else
                {
                    $data = array("msg"=>"Invalid");
                    $json = json_encode($data);
                    echo $json;
                }
            }

        }
    }

    if ($_POST['action'] == "addParticipant")
    {
        if (isset($_POST['albumID']) && isset($_POST['userID']))
        {
            $query = "INSERT INTO tbalbumparticipant (albumID, userID) VALUES ('".$_POST['albumID']."', '".$_POST['userID']."');";

            $res = $mysqli->query($query);
            if ($res)
            {
                $data = array("msg"=>"Valid");
                $json = json_encode($data);
                echo $json;
            }
            else
            {
                $data = array("msg"=>"Invalid");
                $json = json_encode($data);
                echo $json;
            }
        }
    }

    if ($_POST['action'] == "removeParticipant")
    {
        if (isset($_POST['albumID']) && isset($_POST['userID']))
        {
            $query = "DELETE
                    FROM tbalbumparticipant
                    WHERE albumID = ".$_POST['albumID']." AND userID = ".$_POST['userID'];

            $res = $mysqli->query($query);
            if ($res)
            {
                $data = array("msg"=>"Valid");
                $json = json_encode($data);
                echo $json;
            }
            else
            {
                $data = array("msg"=>"Invalid");
                $json = json_encode($data);
                echo $json;
            }
        }
    }

    if ($_POST['action'] == "deleteImage")
    {
        if (isset($_POST['imageID']))
        {
            $filesRemoved = true;

            $query = "SELECT *
                    FROM tbpost
                    WHERE imageID = ".$_POST['imageID'];

            $res = $mysqli->query($query);
            if ($res && $res->num_rows > 0)
            {
                while ($row = $res->fetch_assoc())
                {
                    $file_pointer = "../".$row['fileLocation'];

                    if (!unlink($file_pointer))
                    {
                        //Could not delete file
                        $filesRemoved = false;
                        $data = array("msg"=>"Invalid");
                        $json = json_encode($data);
                        echo $json;
                    }
                }
            }

            if ($filesRemoved)
            {
                $query = "DELETE
                    FROM tbpost
                    WHERE imageID = ".$_POST['imageID'];

                $res = $mysqli->query($query);
                if ($res)
                {
                    $data = array("msg"=>"Valid");
                    $json = json_encode($data);
                    echo $json;
                }
                else
                {
                    $data = array("msg"=>"Invalid");
                    $json = json_encode($data);
                    echo $json;
                }

            }

        }
    }

    if ($_POST['action'] == "addComment")
    {
        if (isset($_POST['imageID']) && isset($_POST['comment']))
        {
            $comment = test_input($_POST['comment']);
            $query = "INSERT INTO tbpostcomment (imageID,comment,timeStamp,userID) VALUES ('".$_POST['imageID']."', '".$comment."',NOW(),'".$_SESSION['userID']."' );";

            $res = $mysqli->query($query);
            if ($res)
            {
                $data = array("msg"=>"Valid","userID"=>$_SESSION['userID'], "profileImage"=> $_SESSION['userProfileImg'],
                    "userName"=> $_SESSION['userName'], "comment" => $comment );
                $json = json_encode($data);
                echo $json;
            }
            else
            {
                $data = array("msg"=>"Invalid");
                $json = json_encode($data);
                echo $json;
            }
        }
    }

    if ($_POST['action'] == "reportPost")
    {
        if (isset($_POST['imageID']) && isset($_POST['reasonID']))
        {
            $query = "INSERT INTO tbpostreports (userID, timeStamp,reportReason,imageID) VALUES ('".$_SESSION['userID']."',NOW(), '".$_POST['reasonID']."','".$_POST['imageID']."');";

            $res = $mysqli->query($query);
            if ($res)
            {
                $getNumReportsQuery = "SELECT *
                            FROM tbpostreports
                            WHERE imageID = ".$_POST['imageID']." ;";

                $res = $mysqli->query($getNumReportsQuery);
                if ($res && $res->num_rows > 5)
                {
                    $query = "UPDATE tbpost
                                SET privacy = 'hidden'
                                WHERE imageID = ".$_POST['imageID'].";";

                    $res = $mysqli->query($query);
                }

                $data = array("msg"=>"Valid");
                $json = json_encode($data);
                echo $json;
            }
            else
            {
                $data = array("msg"=>"Invalid");
                $json = json_encode($data);
                echo $json;
            }
        }
    }

    if ($_POST['action'] == "resetPost")
    {
        if (isset($_POST['imageID']))
        {
            $successful = true;

            $query = "UPDATE tbpost
             SET privacy = 'public'
             WHERE imageID = ".$_POST['imageID'].";";
            $res = $mysqli->query($query);
            if (!$res)
                $successful = false;

            if ($successful)
            {
                $query = "DELETE
                FROM tbpostreports
                WHERE imageID = ".$_POST['imageID'];

                $res = $mysqli->query($query);
                if ($res)
                {
                    $data = array("msg"=>"Valid");
                    $json = json_encode($data);
                    echo $json;
                }
                else
                {
                    $data = array("msg"=>"Invalid");
                    $json = json_encode($data);
                    echo $json;
                }
            }
            else
            {
                $data = array("msg"=>"Invalid");
                $json = json_encode($data);
                echo $json;
            }

        }
    }

    if ($_POST['action'] == "deleteReportReason")
    {
        if (isset($_POST['reasonID']))
        {

            $query = "DELETE
                FROM tbpostreportreason
                WHERE ID = ".$_POST['reasonID'];

            $res = $mysqli->query($query);
            if ($res)
            {
                $data = array("msg"=>"Valid");
                $json = json_encode($data);
                echo $json;
            }
            else
            {
                $data = array("msg"=>"Invalid");
                $json = json_encode($data);
                echo $json;
            }
        }
    }

    if ($_POST['action'] == "addReportReason")
    {
        if (isset($_POST['reason']))
        {
            $reason  = test_input($_POST['reason']);
            $query = "INSERT INTO tbpostreportreason (reason) VALUES ('".$reason."');";

            $res = $mysqli->query($query);
            $newReportReasonID = $mysqli->insert_id;
            if ($res)
            {
                $data = array("msg"=>"Valid","reasonID"=>$newReportReasonID);
                $json = json_encode($data);
                echo $json;
            }
            else
            {
                $data = array("msg"=>"Invalid");
                $json = json_encode($data);
                echo $json;
            }
        }
    }

    if ($_POST['action'] == "deleteAdminUser")
    {
        if (isset($_POST['adminID']))
        {
            $query = "UPDATE tbuser
             SET userType = 'user'
             WHERE userID = ".$_POST['adminID'].";";

            $res = $mysqli->query($query);
            if ($res)
            {
                $data = array("msg"=>"Valid");
                $json = json_encode($data);
                echo $json;
            }
            else
            {
                $data = array("msg"=>"Invalid");
                $json = json_encode($data);
                echo $json;
            }
        }
    }

    if ($_POST['action'] == "newAdminUser")
    {
        if (isset($_POST['adminEmail']))
        {
            $query = "SELECT *
                    FROM tbuser
                    WHERE email = '".$_POST['adminEmail']."'";

            $res = $mysqli->query($query);
            if ($res && $res->num_rows > 0)
            {
                $row = $res->fetch_assoc();

                $query = "UPDATE tbuser
                         SET userType = 'admin'
                        WHERE email = '".$_POST['adminEmail']."'";

                $res = $mysqli->query($query);
                if ($res)
                {
                    $data = array("msg"=>"Valid", "adminID"=> $row['userID']);
                    $json = json_encode($data);
                    echo $json;
                }
                else
                {
                    $data = array("msg"=>"Invalid");
                    $json = json_encode($data);
                    echo $json;
                }
            }
            else
            {
                $data = array("msg"=>"Invalid Email address entered");
                $json = json_encode($data);
                echo $json;

            }
        }
    }

    if ($_POST['action'] == "deleteUser")
    {
        if (isset($_POST['userID']))
        {
            $filesRemoved = true;

            $query = "SELECT *
                    FROM tbpost
                    WHERE userID = ".$_POST['userID'];

            $res = $mysqli->query($query);
            if ($res && $res->num_rows > 0)
            {
                while ($row = $res->fetch_assoc())
                {
                    $file_pointer = "../".$row['fileLocation'];

                    if (!unlink($file_pointer))
                    {
                        $filesRemoved = false;
                        $data = array("msg"=>"Invalid");
                        $json = json_encode($data);
                        echo $json;
                    }
                }
            }

            $query = "SELECT *
                    FROM tbuser
                    WHERE userID = ".$_POST['userID'];

            $res = $mysqli->query($query);
            if ($res && $res->num_rows > 0)
            {
                while ($row = $res->fetch_assoc())
                {
                    $file_pointer = "../".$row['profileImage'];

                    if (!unlink($file_pointer))
                    {
                        $filesRemoved = false;
                        $data = array("msg"=>"Invalid");
                        $json = json_encode($data);
                        echo $json;
                    }
                }
            }

            if ($filesRemoved)
            {
                $query = "DELETE
                    FROM tbuser
                    WHERE userID = ".$_POST['userID'];

                $res = $mysqli->query($query);
                if ($res)
                {
                    $data = array("msg"=>"Valid");
                    $json = json_encode($data);
                    echo $json;
                }
                else
                {
                    $data = array("msg"=>"Invalid");
                    $json = json_encode($data);
                    echo $json;
                }
            }
        }
    }

    if ($_POST['action'] == "follow" || $_POST['action'] == "unfollow")
    {

        if (isset($_POST['follower']) && isset($_POST['following']))
        {
            if ($_POST['action'] == "follow")
            {
                $query = "INSERT INTO tbfollower (userIDFollower,userIDFollowing) VALUES ('".$_POST['follower']."','".$_POST['following']."');";

                $res = $mysqli->query($query);
                if ($res)
                {
                    $data = array("msg"=>"Valid");
                    $json = json_encode($data);
                    echo $json;
                }
                else
                {
                    $data = array("msg"=>"Invalid");
                    $json = json_encode($data);
                    echo $json;
                }
            }
            else
            {
                $query = "DELETE
                    FROM tbfollower
                    WHERE userIDFollower = ".$_POST['follower']." AND userIDFollowing = ".$_POST['following'];

                $res = $mysqli->query($query);
                if ($res)
                {
                    $data = array("msg"=>"Valid");
                    $json = json_encode($data);
                    echo $json;
                }
                else
                {
                    $data = array("msg"=>"Invalid");
                    $json = json_encode($data);
                    echo $json;
                }
            }
        }
    }





}

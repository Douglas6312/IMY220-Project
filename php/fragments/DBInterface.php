<?php

include "./globals.php";

if (isset($_POST['action']))
{
    if ($_POST['action'] == "deleteAlbum")   //need to add cascading deletes in here for foreign keys !!!
    {
        if (isset($_POST['albumID']))
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

//    if ($_POST['action'] == "")
//    {
//
//    }

}

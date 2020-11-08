<?php

    $hasPosts = false;

    if (isset($query))
    {
        $res = $mysqli->query($query);
        if ($res && $res->num_rows > 0)
        {
            $count = 0;
            $hasPosts = true;

            echo '<main class="container-fluid pageContent">';
            echo '<div class="row">';

            $numRows = $res->num_rows;
            $resArray = $res->fetch_all(MYSQLI_ASSOC);// Fetch all
            //$res->free_result(); // Free result set
            //print_r($resArray);

            while($count < $numRows)    //have to loop through each song to check if its private then i can only view it if i am a friend...
            {
                echo '<div class="column" id="col1">';
                for ($x = 0; $x < $numRows; $x+=4)
                {
                    $usersName = "";
                    $userInfoQuery = "SELECT * FROM tbuser WHERE userID = ".$resArray[$x]["userID"];
                    $result = $mysqli->query($userInfoQuery);
                    if ($result && $result->num_rows > 0)
                    {
                        $rowResult = $result->fetch_assoc();
                        $usersName = $rowResult["name"];
                    }

                    echo '<div class="img" data-imageid="'.$resArray[$x]["imageID"].'">
                            <img src="'.$resArray[$x]["fileLocation"].'" class="image" alt="Image of Post">
                            <div class="middle">
                                <div class="text top-right"><a href="profile.php?userID='.$resArray[$x]["userID"].'" data-userID="'.$resArray[$x]["userID"].'" class="text-secondary h4">'.$usersName.'</a></div>
                                <div class="text text-middle">'.$resArray[$x]["title"].'</div>
                            </div>
                            <div class="bottom">
                                <div class="text bottom-left ml-1">
                                    <span> | ISO <b>'.$resArray[$x]["iso"].'</b> |</span>
                                    <span> <b>'.$resArray[$x]["shutterSpeed"].'</b> |</span>
                                    <span> &fnof;<b>'.$resArray[$x]["fStop"].'</b> |</span>
                                    <span> <b>'.$resArray[$x]["lens"].'</b> |</span>
                                </div>
                                <div class="text bottom-right mr-1 likePhoto"><a href="#" data-postID="1234"><i class="fa fa-star-o" aria-hidden="true"></i></a><span data-hasstared="false">'.$resArray[$x]["stars"].'</span></div>
                            </div>
                        </div>';

                    $count++;
                }
                echo '</div>';

                echo '<div class="column" id="col1">';
                for ($x = 1; $x < $numRows; $x+=4)
                {
                    $usersName = "";
                    $userInfoQuery = "SELECT * FROM tbuser WHERE userID = ".$resArray[$x]["userID"];
                    $result = $mysqli->query($userInfoQuery);
                    if ($result && $result->num_rows > 0)
                    {
                        $rowResult = $result->fetch_assoc();
                        $usersName = $rowResult["name"];
                    }

                    echo '<div class="img" data-imageid="'.$resArray[$x]["imageID"].'">
                            <img src="'.$resArray[$x]["fileLocation"].'" class="image" alt="Image of Post">
                            <div class="middle">
                                <div class="text top-right"><a href="profile.php?userID='.$resArray[$x]["userID"].'" data-userID="'.$resArray[$x]["userID"].'" class="text-secondary h4">'.$usersName.'</a></div>
                                <div class="text text-middle">'.$resArray[$x]["title"].'</div>
                            </div>
                            <div class="bottom">
                                <div class="text bottom-left ml-1">
                                    <span> | ISO <b>'.$resArray[$x]["iso"].'</b> |</span>
                                    <span> <b>'.$resArray[$x]["shutterSpeed"].'</b> |</span>
                                    <span> &fnof;<b>'.$resArray[$x]["fStop"].'</b> |</span>
                                    <span> <b>'.$resArray[$x]["lens"].'</b> |</span>
                                </div>
                                <div class="text bottom-right mr-1 likePhoto"><a href="#" data-postID="1234"><i class="fa fa-star-o" aria-hidden="true"></i></a><span data-hasstared="false">'.$resArray[$x]["stars"].'</span></div>
                            </div>
                        </div>';

                    $count++;
                }
                echo '</div>';

                echo '<div class="column" id="col1">';
                for ($x = 2; $x < $numRows; $x+=4)
                {
                    $usersName = "";
                    $userInfoQuery = "SELECT * FROM tbuser WHERE userID = ".$resArray[$x]["userID"];
                    $result = $mysqli->query($userInfoQuery);
                    if ($result && $result->num_rows > 0)
                    {
                        $rowResult = $result->fetch_assoc();
                        $usersName = $rowResult["name"];
                    }

                    echo '<div class="img" data-imageid="'.$resArray[$x]["imageID"].'">
                            <img src="'.$resArray[$x]["fileLocation"].'" class="image" alt="Image of Post">
                            <div class="middle">
                                <div class="text top-right"><a href="profile.php?userID='.$resArray[$x]["userID"].'" data-userID="'.$resArray[$x]["userID"].'" class="text-secondary h4">'.$usersName.'</a></div>
                                <div class="text text-middle">'.$resArray[$x]["title"].'</div>
                            </div>
                            <div class="bottom">
                                <div class="text bottom-left ml-1">
                                    <span> | ISO <b>'.$resArray[$x]["iso"].'</b> |</span>
                                    <span> <b>'.$resArray[$x]["shutterSpeed"].'</b> |</span>
                                    <span> &fnof;<b>'.$resArray[$x]["fStop"].'</b> |</span>
                                    <span> <b>'.$resArray[$x]["lens"].'</b> |</span>
                                </div>
                                <div class="text bottom-right mr-1 likePhoto"><a href="#" data-postID="1234"><i class="fa fa-star-o" aria-hidden="true"></i></a><span data-hasstared="false">'.$resArray[$x]["stars"].'</span></div>
                            </div>
                        </div>';

                    $count++;
                }
                echo '</div>';

                echo '<div class="column" id="col1">';
                for ($x = 3; $x < $numRows; $x+=4)
                {
                    $usersName = "";
                    $userInfoQuery = "SELECT * FROM tbuser WHERE userID = ".$resArray[$x]["userID"];
                    $result = $mysqli->query($userInfoQuery);
                    if ($result && $result->num_rows > 0)
                    {
                        $rowResult = $result->fetch_assoc();
                        $usersName = $rowResult["name"];
                    }

                    echo '<div class="img" data-imageid="'.$resArray[$x]["imageID"].'">
                            <img src="'.$resArray[$x]["fileLocation"].'" class="image" alt="Image of Post">
                            <div class="middle">
                                <div class="text top-right"><a href="profile.php?userID='.$resArray[$x]["userID"].'" data-userID="'.$resArray[$x]["userID"].'" class="text-secondary h4">'.$usersName.'</a></div>
                                <div class="text text-middle">'.$resArray[$x]["title"].'</div>
                            </div>
                            <div class="bottom">
                                <div class="text bottom-left ml-1">
                                    <span> | ISO <b>'.$resArray[$x]["iso"].'</b> |</span>
                                    <span> <b>'.$resArray[$x]["shutterSpeed"].'</b> |</span>
                                    <span> &fnof;<b>'.$resArray[$x]["fStop"].'</b> |</span>
                                    <span> <b>'.$resArray[$x]["lens"].'</b> |</span>
                                </div>
                                <div class="text bottom-right mr-1 likePhoto"><a href="#" data-postID="1234"><i class="fa fa-star-o" aria-hidden="true"></i></a><span data-hasstared="false">'.$resArray[$x]["stars"].'</span></div>
                            </div>
                        </div>';

                    $count++;
                }
                echo '</div>';
            }
            echo '</div>';
            echo '</main>';
        }
    }

    if (!$hasPosts && isset($infoMsg))
    {
        echo '<br/><br/>
            <div class="container" id="infoMsg">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  <strong>'.$infoMsg.'</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>';
    }
?>
<?php

    $hasAlbums = false;

    if (isset($query1))
    {
        $res = $mysqli->query($query1);
        if ($res && $res->num_rows > 0)
        {
            $hasAlbums = true;

            echo '<main class="pageContent">';
            echo '<div class="row">';

            while($row = $res->fetch_assoc()) //check each album to check if the curr user can view it  !!!!!
            {
                echo '<div class="col-sm-12 col-lg-6">
                            <a class="albumCar m-1" href="album.php?albumID='.$row["albumID"].'">
                                <div class="card border">
                                    <h5 class="card-header"><b>'.$row["title"].'</b>';
                                    if ($row["privacy"] == "private")
                                        echo '<i class="fa fa-lock privacyIcon" aria-hidden="true"></i>';
                                    else
                                        echo '<i class="fa fa-unlock privacyIcon" aria-hidden="true"></i>';
                               echo'</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <h5 class="card-title">'.$row["description"].'</h5>
                                                <p class="card-text">';
                                                $hashtagQuery = "SELECT *
                                                            FROM tbalbumhashtag
                                                            WHERE albumID = ".$row["albumID"]."
                                                            LIMIT 2;";
                                                $result = $mysqli->query($hashtagQuery);
                                                if ($result && $result->num_rows > 0)
                                                {
                                                    while($rowResult = $result->fetch_assoc())
                                                    {
                                                        echo $rowResult["hashtag"].' ';
                                                    }
                                                }
                                               echo '</p>
                                            </div>
                                            <div class="imgPreview">';
                                            $picQuery = "SELECT *
                                            FROM tbpost
                                            WHERE albumID = ".$row["albumID"]." AND privacy != 'hidden'
                                            LIMIT 3;";
                                            $result = $mysqli->query($picQuery);
                                            if ($result && $result->num_rows > 0)
                                            {
                                                while($rowResult = $result->fetch_assoc())
                                                {
                                                    echo '<img alt="Preview Image" src="'.$rowResult["fileLocation"].'" />';
                                                }
                                            }
                                        echo '</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>';
                //print_r(array_values($row));
            }
            echo '</div>';
            echo '</main>';
        }
    }

    if (isset($query2))
    {
        $res = $mysqli->query($query2);
        if ($res && $res->num_rows > 0)
        {
            $hasAlbums = true;

            echo '<div  class="heading mt-0">
                <h1>Albums Shared With Me</h1>
            </div>';

            echo '<main class="pageContent">';
            echo '<div class="row">';

            while($row = $res->fetch_assoc()) //check each album to check if the curr user can view it  !!!!!
            {
                echo '<div class="col-sm-12 col-lg-6">
                            <a class="albumCar m-1" href="album.php?albumID='.$row["albumID"].'">
                                <div class="card border">
                                    <h5 class="card-header"><b>'.$row["title"].'</b>
                                    <i class="fa fa-users privacyIcon" aria-hidden="true"></i>
                                    </h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <h5 class="card-title">'.$row["description"].'</h5>
                                                <p class="card-text">';
                                                $hashtagQuery = "SELECT *
                                                            FROM tbalbumhashtag
                                                            WHERE albumID = ".$row["albumID"]."
                                                            LIMIT 2;";
                                                $result = $mysqli->query($hashtagQuery);
                                                if ($result && $result->num_rows > 0)
                                                {
                                                    while($rowResult = $result->fetch_assoc())
                                                    {
                                                        echo $rowResult["hashtag"].' ';
                                                    }
                                                }
                                                echo '</p>
                                            </div>
                                            <div class="imgPreview">';
                                            $picQuery = "SELECT *
                                            FROM tbpost
                                            WHERE albumID = ".$row["albumID"]."  AND privacy != 'hidden'
                                            LIMIT 3;";
                                            $result = $mysqli->query($picQuery);
                                            if ($result && $result->num_rows > 0)
                                            {
                                                while($rowResult = $result->fetch_assoc())
                                                {
                                                    echo '<img alt="Preview Image" src="'.$rowResult["fileLocation"].'" />';
                                                }
                                            }
                                            echo '</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>';

                //print_r(array_values($row));
            }
            echo '</div>';
            echo '</main>';
        }
    }

    if (!$hasAlbums && isset($infoMsg))
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

<?php
include "./fragments/globals.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <meta charset="utf-8" />
    <meta name="author" content="Douglas van Reeuwyk">
    <?php include "./fragments/cssLibraries.php"; ?>
    <link rel="stylesheet" type="text/css" href="../css/admin.css" />
    <link rel="stylesheet" type="text/css" href="../css/postsFragment.css" />
</head>
<body>

<?php include "./fragments/navbarFragment.php"; ?>

<div  class="heading">
    <h1>Admin Settings</h1>
</div>
<div  class="heading mt-3">
    <h1>Reported Posts</h1>
</div>
<?php

$query = "SELECT *
        FROM tbpost
        WHERE imageID IN (SELECT tbpostreports.imageID FROM tbpostreports)
        ORDER BY timeStamp DESC;";

$res = $mysqli->query($query);
if ($res && $res->num_rows > 0)
{
    echo '<main class="container-fluid pageContent">';

    echo '<div class="row">';
    $numRows = $res->num_rows;
    $resArray = $res->fetch_all(MYSQLI_ASSOC);// Fetch all

    for ($x = 0; $x < $numRows; $x++)
    {
        $usersName = "";
        $userInfoQuery = "SELECT * FROM tbuser WHERE userID = ".$resArray[$x]["userID"];
        $result = $mysqli->query($userInfoQuery);
        if ($result && $result->num_rows > 0)
        {
            $rowResult = $result->fetch_assoc();
            $usersName = $rowResult["name"];
        }
        echo '<div class="columnAdmin col-lg-12 col-xl-6 mb-2" id="image'.$resArray[$x]["imageID"].'">';
        echo '<div class="row">';
        echo '<div class="col-6">';
        echo '<div class="img" data-imageid="'.$resArray[$x]["imageID"].'">
                    <img src="../gallery/'.$resArray[$x]["fileLocation"].'" class="image" alt="Image of Post">
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
        echo '</div>';

        echo '<div class="col-6">';
        echo '<div class="reportsTable">
                <table class="table table-bordered">
                <a class="btn btn-warning col-6 text-white resetPost mb-2" data-imageid="'.$resArray[$x]["imageID"].'"><i class="fa fa-undo" aria-hidden="true"></i> reset/ un-report</a>
                <a class="btn btn-danger col-6 text-white deletePost mb-2" data-imageid="'.$resArray[$x]["imageID"].'"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</a>
                      <thead>
                        <tr class="p-0">
                          <th scope="col">#</th>
                          <th scope="col">userID</th>
                          <th scope="col">Reason</th>
                        </tr>
                      </thead>
                      <tbody lass="m-4">';
                        $getImageReportInfo = "SELECT *
                                                FROM tbpostreports
                                                INNER JOIN tbpostreportreason t on tbpostreports.reportReason = t.ID
                                                WHERE imageID = ".$resArray[$x]["imageID"].";";

                        $result = $mysqli->query($getImageReportInfo);
                        if ($result && $result->num_rows > 0)
                        {
                            $count = 1;
                            while($rowResult = $result->fetch_assoc())
                            {
                                echo '<tr>
                                          <th scope="row">'.$count.'</th>
                                          <td>'.$rowResult['userID'].'</td>
                                          <td>'.$rowResult['reason'].'</td>
                                    </tr>';
                                $count++;
                            }
                        }
                      echo '</tbody>
                    </table>
                </div>';

        echo '</div>';

        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
    echo '</main>';
}
else
{
    echo '<br/><br/>
            <div class="container" id="infoMsg">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  <strong>There are no Posts that have been reported</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>';
}
?>

<div  class="heading mt-3">
    <h1>Report Reasons | Add + Remove Admin Users</h1>
</div>

<?php
        echo '<div class="row">

                <div class="pageContent col-lg-12 col-xl-6 mb-2">
                <table class="table table-bordered">
                <a class="btn btn-secondary col-12 text-white addReportReason mb-2"><i class="fa fa-plus" aria-hidden="true"></i> Report Reason</a>
                      <thead>
                        <tr class="p-0">
                          <th scope="col">Reason</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody class="m-4 reasonTBL">';
                    $getImageReportInfo = "SELECT *
                    FROM tbpostreportreason";
                    $result = $mysqli->query($getImageReportInfo);
                    if ($result && $result->num_rows > 0)
                    {
                        while($rowResult = $result->fetch_assoc())
                        {
                            echo '<tr id="reason'.$rowResult["ID"].'">
                                      <td class="align-middle">'.$rowResult['reason'].'</td>
                                      <td><a class="btn btn-danger btn-sm col-12 text-white deleteReportReason" data-reasonid="'.$rowResult["ID"].'"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</a></td>
                                </tr>';
                        }
                    }
                    echo '</tbody>
                    </table>
                </div>
                
                <div class="pageContent col-lg-12 col-xl-6 mb-2">
                <table class="table table-bordered">
                <a class="btn btn-secondary col-12 text-white addAdminUser mb-2"><i class="fa fa-plus" aria-hidden="true"></i> Admin User</a>
                      <thead>
                        <tr class="p-0">
                          <th scope="col">Email</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody class="m-4 adminTBL">';
                        $getImageReportInfo = "SELECT *
                                            FROM tbuser
                                            WHERE userType = 'admin'";
                        $result = $mysqli->query($getImageReportInfo);
                        if ($result && $result->num_rows > 0)
                        {
                            while($rowResult = $result->fetch_assoc())
                            {
                               if ($rowResult['userID'] != $_SESSION['userID'])
                               {
                                   echo '<tr id="admin'.$rowResult["userID"].'">
                                              <td class="align-middle">'.$rowResult['email'].'</td>
                                              <td><a class="btn btn-danger btn-sm col-12 text-white removeAdminUser" data-adminid="'.$rowResult["userID"].'"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</a></td>
                                        </tr>';
                               }
                            }
                        }
                        echo '</tbody>
                    </table>
                </div>';
                
            echo '</div>';
?>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

    <?php include "./fragments/jsLibraries.php"; ?>
    <script src="../js/admin.js"></script>
    <script src="../js/postsFragment.js"></script>
</body>
</html>


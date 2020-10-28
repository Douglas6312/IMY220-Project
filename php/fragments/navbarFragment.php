<header id="topHeader" class="fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-lg-0">

            <a class="navbar-brand ml-2" href="./myFeed.php">
                <h1 class="logo"><img src="../assets/logo1.png" alt="logo" class="img-fluid">PhotoFrames</h1>
            </a>

            <button class="navbar-toggler" type="button"
                    data-toggle="collapse"
                    data-target="#navbarResponsive"
                    aria-controls="navbarResponsive"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto mr-auto">
                    <li class="nav-item mx-1" id="feedLink"><a class="nav-link" href="./myFeed.php">My Feed</a></li>
                    <li class="nav-item mx-1" id="postLink"><a class="nav-link" href="./posts.php">My Posts</a></li>
                    <li class="nav-item mx-1" id="albumLink"><a class="nav-link" href="./albums.php">My Albums</a></li>
                    <li class="nav-item mx-1" id="exploreLink"><a class="nav-link" href="./explore.php">Explore</a></li>
                </ul>
                <ul class="navbar-nav float-right">
                    <a class="nav-link mr-2 p-0" id="messagesLink" href="./messages.php">
                        <span class="fa-stack">
                            <i class="fa fa-comment fa-stack-2x"></i>
                            <strong class="fa-stack-1x fa-stack-text fa-inverse"><?php echo $numUnreadMessages ?></strong>
                        </span>
                    </a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdownLink" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['userName'] ?></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="./myProfile.php">View Profile</a>
                            <?php
                            if ($_SESSION['userType'] == "admin")
                            {
                                echo '<a class="dropdown-item text-danger" href="./admin.php">Admin Settings</a>';
                            }
                            ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="logout" href="../index.php">Logout</a>
                        </div>
                    </li>
                </ul>
                <?php
                if ($_SESSION['userType'] == "admin")
                {
                    echo ' <img src="../assets/default.png" alt="Avatar" class="adminAvatar mr-0">
                                <i class="fa fa-star ml-0 mb-4" aria-hidden="true"></i>';
                }
                else
                {
                    echo ' <img src="../assets/default.png" alt="Avatar" class="avatar mr-2">';
                }
                ?>
            </div>

        </nav>
    </div>
</header>

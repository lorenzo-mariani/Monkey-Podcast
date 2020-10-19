<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: ./index.php");
    }
    if(!isset($_SESSION['channelName'])){
        $_SESSION['channelName'] = basename(__FILE__, '.php');
    } else if($_SESSION['channelName'] != basename(__FILE__, '.php')){
        $_SESSION['channelName'] = basename(__FILE__, '.php');
    }
    
    require "../../../includes/dbh.inc.php";
?>
<body>
    <div class="profile-cnt">
        <div class="tabs-container">
            <ul class="tabs-menu">
                <li id="home">HOME</li>
                <li id="channels">CHANNELS</li>
            </ul>
        </div>
        <div class="info-container"
        <?php
        $query = "SELECT channelImg FROM channels WHERE channelName=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("Location: ./feffo.php?error=sqerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['channelName']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $stmt->bind_result($podcast_img);
            while($stmt->fetch()){
                echo "style=\"background:url('".str_replace("../", "./",$podcast_img)."') no-repeat center;
                background-size: cover;\"";
            }
            mysqli_stmt_close($stmt);
        }
        ?>>
            <div class="left-column">
                <img src="./icon/user.png" alt="User Profile" id="profile-img">
                <ul class="info">
                    <li id="username">
                        <?php
                            echo strtoupper(basename(__FILE__, '.php'));
                        ?>
                    </li>
                    <br>
                    <li id="subs">
                        <?php
                            $query = "SELECT  subs FROM users WHERE uidUsers=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $query)) {
                                header("Location: ./feffo.php?error=sqerror");
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $_SESSION['channelName']);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_store_result($stmt);
                                $stmt->bind_result($subs);
                                $result_check = mysqli_stmt_num_rows($stmt);
                                if($result_check > 0) {
                                    while($stmt->fetch()){
                                        echo $subs;
                                    }
                                } else {
                                    echo $result_check;
                                }
                            }
                            mysqli_stmt_close($stmt);
                        ?>
                    </li>
                    <?php
                        if($_SESSION['channelName'] == $_SESSION['userUid']) {
                            echo "<div id=\"upload-img-container\">
                            <form action=\"./upload-channel-img.php\" method=\"post\">        
                                <button id=\"upload-img-btn\" type=\"submit\" name=\"upload-img-btn\">
                                    <h4 id=\"upload-img-label\">UPLOAD CHANNEL IMAGE</h4>
                                    <img id=\"upload-img-icon\" src=\"./icon/upload-img.png\">
                                </button>
                            </form>
                            </div>";
                        }
                    ?>
                    <?php
                    if($_SESSION['userUid'] != basename(__FILE__, '.php')){

                        $query = "SELECT channelName FROM subscriptions WHERE subUid=? && channelName=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $query)) {
                            header("Location: ./prova.php?error=sqerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userUid'], $_SESSION['channelName']);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                            $resultCheck = mysqli_stmt_num_rows($stmt);
                            if($resultCheck == 0) {
                                echo
                                "<form action=\"./includes/subscribe.inc.php\" method=\"post\">
                                    <button id=\"subscribe-button\" name=\"subscribe-btn\">
                                        SUBSCRIBE
                                    </button>
                                </form>";
                            } else if($resultCheck == 1){
                                echo
                                "<form action=\"./includes/unsubscribe.inc.php\" method=\"post\">
                                    <button id=\"unsubscribe-button\" name=\"unsubscribe-btn\">
                                        UNSUBSCRIBE
                                    </button>
                                </form>";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                ?>
                </ul>
            </div>
            <div class="right-column">
                <br>
                <h3>DESCRIPTION</h3>
                <br>
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
        <div class="views-container">
            <h3>123.456.789 views</h3>
        </div>
        <div class="podcasts-container">
            <?php

                $query = "SELECT podcastTitle, podcastImg, podcastViews, podcastFile FROM podcasts WHERE userUID=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header("Location: ./prova.php?error=sqerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['channelName']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $stmt->bind_result($title, $podcast_img, $streams, $podcast_file);
                    $channel_name = $_SESSION['channelName'];
                    while($stmt->fetch()){
                        echo
                        "<div class=\"grid-element\"  id=".str_replace("../", "./", $podcast_file).">
                            <img src=".str_replace("../", "./",$podcast_img)." alt=\"Sample1\">
                            <h4 id=".$channel_name.">".strtoupper(str_replace('_', ' ', $title))."</h4>
                            <p>".$streams."</p>
                        </div>";
                    }
                }
                mysqli_stmt_close($stmt);
            ?>
        </div>
        <div class="channels-container">
        <?php
                $query = "SELECT channelName, subs
                FROM (SELECT channelName, subUid FROM subscriptions as sub
                INNER JOIN 
                users as u1
                ON sub.subUid = u1.uidUsers) as t1
                INNER JOIN
                users as u2
                ON t1.channelName = u2.uidUsers
                WHERE subUid=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header("Location: ./prova.php?error=sqerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['channelName']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $stmt->bind_result($channel_name, $subs);
                    $result_check = mysqli_stmt_num_rows($stmt);
                    if($result_check > 0) {
                        while($stmt->fetch()){
                            echo
                            "
                            <div class=\"channel\">
                            <img src=\"./icon/user.png\" alt=\"User Profile\" id=\"channel-img\">
                                <ul class=\"channel-info\" id=".$channel_name.">
                                    <li id=\"name\">".$channel_name."</li>
                                    <li id=\"channel-subs\">".$subs."</li>
                                </ul>
                                </form>
                            </div>
                            ";
                        }
                    } else {
                        echo $result_check;
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            ?>
        </div>
    </div>
    <script src=<?php 
                echo "'./content/users/".basename(__FILE__, '.php')."/".basename(__FILE__, '.php').".js'";
            ?>>
    </script>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./load_audio.js"></script>
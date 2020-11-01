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
        <?php
        $query = "SELECT channelImg FROM channels WHERE channelName=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("Location: ./home.php?error=profilesqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['channelName']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $stmt->bind_result($podcast_img);
            while($stmt->fetch()){
                if($podcast_img != '') {
                    echo "<div id=\"chimg-container\" style=\"background:url('"."../", "./",$podcast_img."') no-repeat center;
                    background-size: cover;
                    display: flex;
                    flex-wrap: nowrap;
                    width: 100%;
                    background-color: black;
                    height: 150px;\">
                    </div>";
                }
            }
            mysqli_stmt_close($stmt);
        }
        ?>
        <div class="tabs-container">
            <ul class="tabs-menu">
                <li id="home">HOME</li>
                <li id="channels">CHANNELS</li>
            </ul>
        </div>
        <div id="info-container">
            <div id="profile-container">
                <img src="./icon/user.png" alt="User Profile" id="profile-img">
                    <h4 id="username">
                        <?php
                            echo strtoupper(basename(__FILE__, '.php'));
                        ?>
                    </h4>
                    <h4 id="subs">
                        <?php
                            $query = "SELECT  subs FROM users WHERE uidUsers=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $query)) {
                                header("Location: ./home.php?error=profilesqlerror");
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
                        SUBS
                    </h4>
                    <?php
                        if($_SESSION['userUid'] == $_SESSION['channelName']){
                            echo "<img id=\"settings\" src=\"./icon/settings-dark.png\" alt=\"settings\">";
                        }
                    ?>
            </div>
            <div id="subscribe-container">
                    <?php
                    if($_SESSION['userUid'] != basename(__FILE__, '.php')){

                        $query = "SELECT channelName FROM subscriptions WHERE subUid=? && channelName=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $query)) {
                            header("Location: ./home.php?error=profilesqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userUid'], $_SESSION['channelName']);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                            $resultCheck = mysqli_stmt_num_rows($stmt);
                            if($resultCheck == 0) {
                                echo
                                "<form id=\"sub\" action=\"./includes/subscribe.inc.php\" method=\"post\">
                                    <button id=\"subscribe-button\" name=\"subscribe-btn\" value=\"dark\">
                                        SUBSCRIBE
                                    </button>
                                </form>";
                            } else if($resultCheck == 1){
                                echo
                                "<form id=\"sub\" action=\"./includes/unsubscribe.inc.php\" method=\"post\">
                                    <button id=\"unsubscribe-button\" name=\"unsubscribe-btn\">
                                        UNSUBSCRIBE
                                    </button>
                                </form>";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                ?>
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
                </ul>
            </div>
        </div>
        <div id="streams-container">
            <h3>
                <?php
                    $query = "SELECT channelStreams FROM channels WHERE channelName=?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        header("Location: ./home.php?error=profilesqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['channelName']);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        $stmt->bind_result($ch_streams);
                        $result_check = mysqli_stmt_num_rows($stmt);
                        if($result_check > 0) {
                            while($stmt->fetch()){
                                echo $ch_streams." STREAMS";
                            }
                        } else {
                            echo $result_check;
                        }
                    }
                    mysqli_stmt_close($stmt);
                ?>
            </h3>
        </div>
        <div id="profile-home-container">
            <div id="noplaylist-container">
                <?php

                    $query = "SELECT genre, podcastTitle, podcastImg, podcastStreams, podcastFile, playlist FROM podcasts WHERE userUID=? ORDER BY playlist ASC";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        header("Location: ./home.php?error=profilesqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['channelName']);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        $stmt->bind_result($genre, $title, $podcast_img, $streams, $podcast_file, $playlist);
                        $channel_name = $_SESSION['channelName'];
                        $playlist_tmp = NULL;
                        $check = 0;
                        while($stmt->fetch()){
                            if($playlist_tmp != $playlist) {
                                
                                echo "<div class=\"playlist-container\">
                                    <h4 id=\"playlist\">".strtoupper(str_replace('_', ' ', $playlist))."</h4>
                                </div>";
                                    
                            } else if($playlist == "none" && $check != 1){
                                $check = 1;
                                echo "<div class=\"playlist-container\">
                                <h4 id=\"some-podcasts\">SOME PODCASTS</h4>";
                            }
                            echo
                            "<div class=\"grid-element-profile\">
                                <img id=".$podcast_file." class=\"podcast-thumbnail\" src=".$podcast_img.">
                                <div id=\"pod-info-container\">
                                    <h4 class=\"podcast-title\" id=".$channel_name.">".strtoupper(str_replace('_', ' ', $title))."</h4>
                                    <p>".$streams." STREAMS</p>";
                                    if($_SESSION['userUid'] == $_SESSION['channelName']){
                                        echo "<div class=\"mod-btns-container\">
                                        <form action=\"./includes/deletepod.inc.php\" method=\"post\">
                                                <button class=\"podcast-delete-btn\" type=\"submit\" name=\"pod-delete-submit\" value=\"".$title."\">
                                                    <img class=\"delete-podcast\" src=\"./icon/trash.png\" alt=\"delete\">
                                                </button>
                                            </form>
                                            <img class=\"podcast-settings\" src=\"./icon/settings-dark.png\" alt=\"settings\">
                                            </div>";
                                    }
                                echo "</div>
                                </div>";
                            $playlist_tmp = $playlist;
                        }
                    }
                    mysqli_stmt_close($stmt);
                ?>
            </div>
        </div>
        <div id="channels-container">
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
                    header("Location: ./home.php?error=profilesqlerror");
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
                                    <li id=\"name\">".strtoupper($channel_name)."</li>
                                    <li id=\"channel-subs\">".$subs." SUBS</li>
                                </ul>
                                </form>
                            </div>
                            ";
                        }
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
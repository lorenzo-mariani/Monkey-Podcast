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
        $query_img = "SELECT channelImg FROM channels WHERE channelName=?";
        $stmt_img = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt_img, $query_img)) {
            header("Location: ./home.php?error=profilesqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt_img, "s", $_SESSION['channelName']);
            mysqli_stmt_execute($stmt_img);
            mysqli_stmt_store_result($stmt_img);
            $stmt_img->bind_result($podcast_img);
            while($stmt_img->fetch()){
                if($podcast_img != '') {
                    echo "<div id=\"chimg-container\" style=\"background:url('".$podcast_img."') no-repeat center;
                    background-size: cover;
                    display: flex;
                    flex-wrap: nowrap;
                    width: 100%;
                    background-color: black;
                    height: 150px;\">
                    </div>";
                }
            }
            mysqli_stmt_close($stmt_img);
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
                            $query_subs = "SELECT  subs FROM users WHERE uidUsers=?";
                            $stmt_subs = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt_subs, $query_subs)) {
                                header("Location: ./home.php?error=profilesqlerror");
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt_subs, "s", $_SESSION['channelName']);
                                mysqli_stmt_execute($stmt_subs);
                                mysqli_stmt_store_result($stmt_subs);
                                $stmt_subs->bind_result($subs);
                                $result_check = mysqli_stmt_num_rows($stmt_subs);
                                if($result_check > 0) {
                                    while($stmt_subs->fetch()){
                                        echo $subs;
                                    }
                                } else {
                                    echo $result_check;
                                }
                            }
                            mysqli_stmt_close($stmt_subs);
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

                        $query_name = "SELECT channelName FROM subscriptions WHERE subUid=? && channelName=?";
                        $stmt_name = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt_name, $query_name)) {
                            header("Location: ./home.php?error=profilesqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt_name, "ss", $_SESSION['userUid'], $_SESSION['channelName']);
                            mysqli_stmt_execute($stmt_name);
                            mysqli_stmt_store_result($stmt_name);
                            $resultCheck = mysqli_stmt_num_rows($stmt_name);
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
                        mysqli_stmt_close($stmt_name);
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
                    $query_streams = "SELECT channelStreams FROM channels WHERE channelName=?";
                    $stmt_streams = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt_streams, $query_streams)) {
                        header("Location: ./home.php?error=profilesqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt_streams, "s", $_SESSION['channelName']);
                        mysqli_stmt_execute($stmt_streams);
                        mysqli_stmt_store_result($stmt_streams);
                        $stmt_streams->bind_result($ch_streams);
                        $result_check = mysqli_stmt_num_rows($stmt_streams);
                        if($result_check > 0) {
                            while($stmt_streams->fetch()){
                                echo $ch_streams." STREAMS";
                            }
                        } else {
                            echo $result_check;
                        }
                    }
                    mysqli_stmt_close($stmt_streams);
                ?>
            </h3>
        </div>
        <div id="profile-home-container">
            <?php

                $query_pod = "SELECT genre, podcastTitle, podcastImg, podcastStreams, podcastFile, playlist FROM podcasts WHERE userUID=? ORDER BY playlist ASC, podcastTitle ASC";
                $stmt_pod = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt_pod, $query_pod)) {
                    header("Location: ./home.php?error=profilesqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt_pod, "s", $_SESSION['channelName']);
                    mysqli_stmt_execute($stmt_pod);
                    mysqli_stmt_store_result($stmt_pod);
                    $stmt_pod->bind_result($genre, $title, $podcast_img, $streams, $podcast_file, $playlist);
                    $channel_name = $_SESSION['channelName'];
                    $playlist_tmp = NULL;
                    while($stmt_pod->fetch()){
                        if($playlist_tmp != $playlist) {
                            if($playlist_tmp != NULL){
                                echo "</div>";
                            }
                            echo "<div class=\"playlist-container\">
                                <h4 id=\"playlist\">".strtoupper(str_replace('_', ' ', $playlist))."</h4>
                            </div>
                            <div class=\"playlist-podcasts-container\">";
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
                mysqli_stmt_close($stmt_pod);
            ?>
        </div>
        <div id="channels-container">
        <?php
                $query_chann = "SELECT channelName, subs
                FROM (SELECT channelName, subUid FROM subscriptions as sub
                INNER JOIN 
                users as u1
                ON sub.subUid = u1.uidUsers) as t1
                INNER JOIN
                users as u2
                ON t1.channelName = u2.uidUsers
                WHERE subUid=?";
                $stmt_chann = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt_chann, $query_chann)) {
                    header("Location: ./home.php?error=profilesqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt_chann, "s", $_SESSION['channelName']);
                    mysqli_stmt_execute($stmt_chann);
                    mysqli_stmt_store_result($stmt_chann);
                    $stmt_chann->bind_result($channel_name, $subs);
                    $result_check = mysqli_stmt_num_rows($stmt_chann);
                    if($result_check > 0) {
                        while($stmt_chann->fetch()){
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
                mysqli_stmt_close($stmt_chann);
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
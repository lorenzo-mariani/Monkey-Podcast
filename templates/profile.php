<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: ./index.php");
    }
    
    require "../../../includes/dbh.inc.php";
    $profile = basename(__FILE__, '.php');
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
            mysqli_stmt_bind_param($stmt_img, "s", $profile);
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
            <button id="home-btn">
                <p id="home">HOME
            </button>
            <button id="channels-btn">
                <p id="channels">CHANNELS
            </button>
        </div>
        <div id="info-container">
            <div id="profile-container">
                <img src="./icon/user.png" alt="User Profile" id="profile-img">
                    <h4 id="username">
                        <?php
                            echo strtoupper($profile);
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
                                mysqli_stmt_bind_param($stmt_subs, "s", $profile);
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
                        if($_SESSION['userUid'] == $profile){
                            echo "<form action=\"./includes/deleteaccount.inc.php\" method=\"post\" onsubmit=\"return confirm('Are you shure you want to delete your account? WARNING: THIS OPERATION IS IRREVERSIBLE');\">
                                    <button class=\"account-delete-btn\" type=\"submit\" name=\"account-delete-submit\" value=\"".$_SESSION['userUid']."\">
                                        <img class=\"delete-account\" src=\"./icon/trash.png\" alt=\"delete-account\">
                                    </button>
                                </form>
                                <h4 id=\"delete-account-text\">DELETE ACCOUNT</h4>";
                        }
                    ?>
            </div>
            <div id="subscribe-container">
                    <?php
                    if($_SESSION['userUid'] != $profile){

                        $query_name = "SELECT channelName FROM subscriptions WHERE subUid=? && channelName=?";
                        $stmt_name = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt_name, $query_name)) {
                            header("Location: ./home.php?error=profilesqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt_name, "ss", $_SESSION['userUid'], $profile);
                            mysqli_stmt_execute($stmt_name);
                            mysqli_stmt_store_result($stmt_name);
                            $resultCheck = mysqli_stmt_num_rows($stmt_name);
                            if($resultCheck == 0) {
                                echo
                                "<form id=\"sub\" action=\"./includes/subscribe.inc.php\" method=\"post\">
                                    <button id=\"subscribe-button\" name=\"subscribe-btn\" value=\"".$profile."\">
                                        SUBSCRIBE
                                    </button>
                                </form>";
                            } else if($resultCheck == 1){
                                echo
                                "<form id=\"sub\" action=\"./includes/unsubscribe.inc.php\" method=\"post\">
                                    <button id=\"unsubscribe-button\" name=\"unsubscribe-btn\" value=\"".$profile."\">
                                        UNSUBSCRIBE
                                    </button>
                                </form>";
                            }
                        }
                        mysqli_stmt_close($stmt_name);
                    }
                ?>
                <?php
                    if($profile == $_SESSION['userUid']) {
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
                        mysqli_stmt_bind_param($stmt_streams, "s", $profile);
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
                    mysqli_stmt_bind_param($stmt_pod, "s", $profile);
                    mysqli_stmt_execute($stmt_pod);
                    mysqli_stmt_store_result($stmt_pod);
                    $stmt_pod->bind_result($genre, $title, $podcast_img, $streams, $podcast_file, $playlist);
                    $channel_name = $profile;
                    $playlist_tmp = NULL;
                    while($stmt_pod->fetch()){
                        if($playlist_tmp != $playlist) {
                            if($playlist_tmp != NULL){
                                echo "</div>";
                            }
                            echo "<div class=\"playlist-container\">
                                <h4 id=\"playlist-name\">".strtoupper(str_replace('_', ' ', $playlist))."</h4>
                            </div>
                            <div class=\"playlist-podcasts-container\">";
                        }
                        echo
                        "<div class=\"grid-element-profile\">
                            <button class=\"podcast-thumbnail-btn\" data-file=\"".$podcast_file."\" data-chname=\"".$channel_name."\" data-playlist=\"".$playlist."\" data-img=\"".$podcast_img."\" data-title=\"".$title."\">
                                <img class=\"podcast-thumbnail\" src=".$podcast_img.">
                            </button>
                            <div id=\"pod-info-container\">";
                                echo "<button class=\"podcast-title-btn\" data-file=\"".$podcast_file."\" data-chname=\"".$channel_name."\" data-playlist=\"".$playlist."\" data-img=\"".$podcast_img."\" data-title=\"".$title."\">
                                    <h4 class=\"podcast-title\" title=\"".ucwords(str_replace('_', ' ', $title))."\">".strtoupper(str_replace('_', ' ', $title))."</h4>
                                </button>
                                <p>".$streams." STREAMS</p>";
                                if($_SESSION['userUid'] == $profile){
                                    echo "<div class=\"mod-btns-container\">
                                    <form action=\"./includes/deletepod.inc.php\" method=\"post\" onsubmit=\"return confirm('Are you shure you want to delete this podcast?');\">
                                            <button class=\"podcast-delete-btn\" type=\"submit\" name=\"pod-delete-submit\" value=\"".$title."\">
                                                <img class=\"delete-podcast\" src=\"./icon/trash.png\" alt=\"delete\">
                                            </button>
                                        </form>";
                                        echo "<button class=\"podcast-settings-btn\">
                                            <img class=\"podcast-settings\" src=\"./icon/settings-dark.png\" alt=\"podcast-settings\">
                                        </button>
                                        </div>";
                                }
                            echo "</div>
                            </div>";
                        $playlist_tmp = $playlist;
                    }
                }
                mysqli_stmt_close($stmt_pod);
                echo "</div>";
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
                    mysqli_stmt_bind_param($stmt_chann, "s", $profile);
                    mysqli_stmt_execute($stmt_chann);
                    mysqli_stmt_store_result($stmt_chann);
                    $stmt_chann->bind_result($channel_name, $subs);
                    $result_check = mysqli_stmt_num_rows($stmt_chann);
                    if($result_check > 0) {
                        while($stmt_chann->fetch()){
                            echo
                            "
                            <button class=\"channel-btn\">
                            <div class=\"channel\">
                            <img src=\"./icon/user.png\" alt=\"User Profile\" id=\"channel-img\">
                                <ul class=\"channel-info\">
                                    <li id=\"name\" title=\"".ucfirst($channel_name)."\">".strtoupper($channel_name)."</li>
                                    <li id=\"channel-subs\">".$subs." SUBS</li>
                                </ul>
                                </form>
                            </div>
                            </button>
                            ";
                        }
                    }
                }
                mysqli_stmt_close($stmt_chann);
                mysqli_close($conn);
            ?>
        </div>
    </div>
    <script src=<?php echo "'./content/users/".$profile."/".$profile.".js'";?>>
    </script>
</body>
</html>
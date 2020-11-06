<?php
    require "./header.php";
?>

<div id="content" <?php
    if(isset($_GET['view'])) {
        if($_GET['view'] == "home"){
            echo "id='home'";
        } else if($_GET['view'] == "profile"){
            echo "id='profile'";
        }
    }  else {
        echo "id='home'";
    }
?>>
    <div id="home-content" <?php
    if(isset($_GET['view'])) {
        if($_GET['view'] == "home"){
            echo "style= 'display: block;'";
        } else if($_GET['view'] == "profile"){
            echo "style= 'display: none;'";

        }
    }
    ?>>
        <?php

            $query = "SELECT userUID, podcastStreams, podcastTitle, podcastImg, channelImg, podcastFile, playlist FROM
            (SELECT userUID, podcastStreams, podcastTitle, podcastImg, podcastFile, playlist FROM
            (SELECT channelName FROM
            subscriptions
            WHERE subUid = ?) as t1
            INNER JOIN
            podcasts
            ON t1.channelName = podcasts.userUID) as t2
            INNER JOIN
            channels
            ON t2.userUid = channels.channelName
            ORDER BY userUID ASC, playlist ASC, podcastTitle ASC";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("Location: ./home.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $_SESSION['userUid']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $stmt->bind_result($channel_name, $streams, $title, $podcast_img, $channel_img, $podcast_file, $playlist);
                if($stmt->num_rows == 0){
                    echo "<div id=\"default-content\">
                        <h1 id=\"welcome-to\">WELCOME TO</h1>
                        <h1 id=\"monkey-podcast\">MONKEY PODCASTS!</h1>
                        <div id=\"welcome-text\">
                            <h3 id=\"get-started\">To get started listening to the best podcasts on the internet type something in the search box above!</h3>
                            <h3 id=\"get-started-or\">OR... UPLOAD SOMETHING YOURS!</h3>
                            <p id=\"text\">We give you unlimited access to all the podcasts that you want to listen!</p>
                            <p id=\"text\">Have a passion for cars? Cats? Business? Computers? We have it all! You only have to search for it!</p>
                        </div>
                    </div>";
                } else {
                    $name_tmp = NULL;
                    $playlist_tmp = NULL;
                    $check_plst = 0;
                    $count = 0;
                    while($stmt->fetch()){
                        if($name_tmp != $channel_name){
                            if($name_tmp != NULL){
                                echo "</div>
                                </div>";
                                $playlist_tmp = NULL;
                            }
                            echo
                            "<div id=\"channel-name-container\" style=\"background: url('".$channel_img."') no-repeat center; background-size:cover\">
                                <button class=\"channel-name-btn\">
                                    <h1 class=\"channel-name\">".strtoupper($channel_name)."</h1>
                                </button>
                            </div>
                            <div class=\"channel-content\">";
                        }
                        if($playlist != "none") {
                            if($playlist_tmp != $playlist){
                                $count = 0;
                                if($playlist_tmp != NULL){
                                    echo "</div>";
                                }
                                echo "<div class=\"playlist-container-home\">
                                <h4 id=\"playlist-home\">".strtoupper(str_replace('_', ' ', $playlist))."</h4>";
                            }
                        } else if($playlist == "none" && $check_plst != 1){
                            $check_plst = 1;
                            echo "<div class=\"playlist-container-home\">
                            <h4 id=\"some-podcasts-home\">SOME PODCASTS</h4>";
                        }
                        if($count < 3){
                            echo
                            "<button class=\"grid-element-btn\" title=\"".$playlist."\">
                            <div class=\"grid-element\"  title=".$podcast_file.">
                                <img src=".$podcast_img." alt=\"podcast-image\">
                                <h4 title=".$channel_name.">".strtoupper(str_replace('_', ' ', $title))."</h4>
                                <p>".$streams." STREAMS</p>
                            </div>
                            </button>";
                        } else if ($count == 3) {
                            echo "<button class=\"show-more-btn\">
                            <p class=\"show-more\" id=".$channel_name.">SHOW MORE...
                            </button>";
                        }
                        $count += 1;
                        $playlist_tmp = $playlist;
                        $name_tmp = $channel_name;
                    }
                    echo "</div>
                    </div>";
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
        
        ?>
    </div>
    <div id="profile-content" <?php
    if(isset($_GET['view'])) {
        if($_GET['view'] == "profile"){
            echo "style= 'display: block;'";
        } else if($_GET['view'] == "home"){
            echo "style= 'display: none;'";

        }
    } else {
        echo "style= 'display: none;'";
    }
    ?>>
    </div>

    <div id="search-content" style="display: none;">
    </div>

    <div id="podcastmod-content" style="display: none;">
    </div>

    <div id="help-content" style="display: none;">
    </div>
</div>
    <?php require "./player.php"; ?>
</body>
</html>
<script src="./load_audio.js"></script>
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

            $query = "SELECT userUID, podcastStreams, podcastTitle, podcastImg, channelImg, podcastFile, playlist, uploadTime FROM
            (SELECT userUID, podcastStreams, podcastTitle, podcastImg, podcastFile, playlist, uploadTime FROM
            (SELECT channelName FROM
            subscriptions
            WHERE subUid = ?) as t1
            INNER JOIN
            podcasts
            ON t1.channelName = podcasts.userUID) as t2
            INNER JOIN
            channels
            ON t2.userUid = channels.channelName
            ORDER BY userUID ASC, playlist ASC, uploadTime DESC";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("Location: ./home.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $_SESSION['userUid']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $stmt->bind_result($channel_name, $streams, $title, $podcast_img, $channel_img, $podcast_file, $playlist, $upload_time);
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
                                    <h1 class=\"channel-name\">".strtoupper(str_replace("_", " ", $channel_name))."</h1>
                                </button>
                            </div>
                            <div class=\"channel-content\">";
                        }
                        if($playlist_tmp != $playlist){
                            $count = 0;
                            if($playlist_tmp != NULL){
                                echo "</div>";
                            }
                            echo "<div class=\"playlist-container-home\">
                            <h4 id=\"playlist-home\">".strtoupper(str_replace('_', ' ', $playlist))."</h4>
                            <div class=\"playlist-content\">";
                        }
                        if($count < 4){
                            echo
                            "<button class=\"grid-element-btn\" data-file=\"".$podcast_file."\" data-chname=\"".$channel_name."\" data-playlist=\"".$playlist."\" data-img=\"".$podcast_img."\" data-title=\"".$title."\">
                            <div class=\"grid-element\">
                                <img src=".$podcast_img." alt=\"podcast-image\">
                                <div class=\"pod-home-details-container\">
                                    <h4 title=\"".ucwords(str_replace('_', ' ', $title))."\">".strtoupper(str_replace('_', ' ', $title))."</h4>
                                    <p>".$streams." STREAMS</p>
                                </div>
                            </div>
                            </button>";
                        } else if ($count == 4) {
                            echo "</div>
                            <button class=\"show-more-btn\" data-name=\"".$channel_name."\">
                            <p class=\"show-more\">SHOW MORE...
                            </button>";
                        }
                        $count += 1;
                        $playlist_tmp = $playlist;
                        $name_tmp = $channel_name;
                    }
                    if($count < 4){
                        echo "</div>";
                    }
                    echo "
                    </div>
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
    <div id="error-container"
        <?php
            if(isset($_GET['error'])){
                echo "style=\"display: grid\"";
            } else if(isset($_GET['warning'])){
                echo "style=\"display: grid\"";
            } else {
                echo "style=\"display: none\"";
            }
        ?>
    >
        <div id="error-msg">
        <?php
            if(isset($_GET['error'])){
                if($_GET['error'] == "exists"){
                    echo "<h4 id=\"error-label\">ERROR: this title already exists.</h4>";
                } else if($_GET['error'] == "sqlerror"){
                    echo "<h4 id=\"error-label\">ERROR: there was an error.</h4>";
                } else if($_GET['error'] == "notfound"){
                    echo "<h4 id=\"error-label\">ERROR: this podcast was not found.</h4>";
                } else if($_GET['error'] == "invalidtitle"){
                    echo "<h4 id=\"error-label\">ERROR: the title is not valid.</h4>";
                }
            } else if(isset($_GET['warning'])){
                if($_GET['warning'] == "emptyfields"){
                    echo "<h4 id=\"error-label\">WARNING: all fields were left empty.</h4>";
                }
            }
        ?>
        <button id="ok-button" type="button" onclick="document.getElementById('error-container').style.display = 'none'">OK</button>
        </div>
    </div>
</div>
    <?php require "./player.php"; ?>
</body>
</html>
<script src="./load_audio.js"></script>
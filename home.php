<?php
    require "./header.php";
?>



<div class="content" <?php
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
    <div class="home-content" <?php
    if(isset($_GET['view'])) {
        if($_GET['view'] == "home"){
            echo "style= 'display: block;'";
        } else if($_GET['view'] == "profile"){
            echo "style= 'display: none;'";

        }
    }
?>>
        <?php

            $query = "SELECT userUID, podcastViews, podcastTitle, podcastImg, channelImg, podcastFile FROM
            (SELECT userUID, podcastViews, podcastTitle, podcastImg, podcastFile FROM
            (SELECT channelName FROM
            subscriptions
            WHERE subUid = ?) as t1
            INNER JOIN
            podcasts
            ON t1.channelName = podcasts.userUID) as t2
            INNER JOIN
            channels
            ON t2.userUid = channels.channelName
            ORDER BY userUID ASC";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("Location: ./prova.php?error=sqerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $_SESSION['userUid']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $stmt->bind_result($channel_name, $streams, $title, $podcast_img, $channel_img, $podcast_file);
                $name_tmp = NULL;
                while($stmt->fetch()){
                    if($name_tmp != $channel_name  || $name_tmp = NULL){
                        if($name_tmp != NULL){
                            echo "</div>";
                        }
                        $file = str_replace("../", "./",$podcast_file);
                        $ch_img = str_replace("../", "./", $channel_img);
                        $pod_img = str_replace("../", "./", $podcast_img);
                        echo
                        "<div id=\"channel-name-container\" style=\"background: url('".$ch_img."') no-repeat center; background-size:cover\">
                            <h1 class=\"channel-name\">".strtoupper($channel_name)."</h1>
                        </div>
                        <div class=\"scrollchannel\">
                            <img class=\"left-scroll-arrow\" src=\"./icon/arrow.png\" alt=\"Left Arrow\">
                            <img class=\"right-scroll-arrow\" src=\"./icon/arrow.png\" alt=\"Right Arrow\">
                        ";
                    }
                    echo 
                    "   <div class=\"grid-element\" id=".$file.">
                            <img src=".$pod_img." alt=\"Sample1\">
                            <h4 id=".$channel_name.">".strtoupper(str_replace('_', ' ', $title))."</h4>
                            <p>".$streams."</p></div>";
                    $name_tmp = $channel_name;
                }
                echo "</div>";
            }
        
        ?> 
    </div>
    <div class="profile-content" <?php
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
</div>
    <?php require "./player.php"; ?>
</body>
</html>
<script src="./load_audio.js"></script>
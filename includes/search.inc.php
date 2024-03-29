<?php

    if(isset($_GET['search'])){

        require 'dbh.inc.php';
        
        $search_text = strtolower(str_replace(" ", "_", $_GET['search']));

        if($search_text != ''){
            echo "<div id=\"search-word-container\">
            <h3 id=\"search-word\">SEARCH RESULTS FOR: \"".strtoupper(str_replace("_", " ", $search_text))."\"</h3>
        </div>";
            $query_users = "SELECT * FROM channels WHERE
                        channelName LIKE CONCAT('%', ?, '%')";
            $query_podcasts = "SELECT * from podcasts WHERE
                            userUID LIKE CONCAT('%', ?, '%')
                            OR podcastTitle LIKE CONCAT('%', ?, '%')
                            OR genre LIKE CONCAT('%', ?, '%')
                            OR playlist LIKE CONCAT('%', ?, '%')
                            ORDER BY podcastTitle ASC";
            $stmt_users = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt_users, $query_users)) {
                header("Location: ./home.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt_users, "s", $search_text);
                mysqli_stmt_execute($stmt_users);
                mysqli_stmt_store_result($stmt_users);
                $stmt_users->bind_result($name, $views, $ch_img);
                if($stmt_users->num_rows > 0){
                    echo "
                    <div id=\"users-container\">USERS</h4>
                    </div>
                        <div id=\"scrollchannel\">
                        ";
                    while($stmt_users->fetch()){
                        if($ch_img != ''){
                            echo 
                            "<button class=\"grid-element-users-btn\">   
                                <div class=\"grid-element-users\">
                                    <img src=".str_replace('../', './', $ch_img).">
                                    <h4 title=\"".ucwords(str_replace('_', ' ', $name))."\">".strtoupper(str_replace("_", " ", $name))."</h4>
                                    <p>".$views." STREAMS</p>
                                </div>
                            </button>";
                        } else {
                            echo 
                            "<button class=\"grid-element-users-btn\">   
                            <div class=\"grid-element-users\">
                                <img>
                                <h4 title=\"".ucwords(str_replace('_', ' ', $name))."\">".strtoupper(str_replace("_", " ", $name))."</h4>
                                <p>".$views." STREAMS</p>
                                </div>
                            </button>";
                        }
                    }
                    echo "</div>";
                } else {
                    echo "<div id=\"users-container\">
                        <h4>USERS</h4>
                        </div>
                    <div id=\"default-search\">
                        <h1 id=\"empty-search\">Sorry, no results found.</h1>
                    </div>";
                }
            }
            mysqli_stmt_close($stmt_users);
            $stmt_podcasts = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt_podcasts, $query_podcasts)) {
                header("Location: ./home.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt_podcasts, "ssss", $search_text, $search_text, $search_text, $search_text);
                mysqli_stmt_execute($stmt_podcasts);
                mysqli_stmt_store_result($stmt_podcasts);
                $stmt_podcasts->bind_result($genre, $title, $img, $channel_name, $streams, $file, $playlist, $update_time);
                $rows = $stmt_podcasts->num_rows;
                if($stmt_podcasts->num_rows > 0){
                    echo "
                    <div id=\"podcasts-container\">
                        <h4>PODCASTS</h4>
                    </div>
                    <div id=\"podcast-search\">
                        <div id=\"podcast-container-search\">
                        ";
                    while($stmt_podcasts->fetch()){
                        echo 
                        "<button class=\"grid-element-btn-search\" data-file=\"".$file."\" data-chname=\"".$channel_name."\" data-playlist=\"".$playlist."\" data-img=\"".$img."\" data-title=\"".$title."\">
                        <div class=\"grid-element-search\">
                            <img class=\"podcast-img-search\" src=".$img.">
                            <h4 class=\"podcast-title-search\" title=\"".ucwords(str_replace('_', ' ', $title))."\">".strtoupper(str_replace('_', ' ', $title))."</h4>
                            <h3 class=\"channel-name-search\" title=\"".ucwords(str_replace('_', ' ', $channel_name))."\">".strtoupper(str_replace('_', ' ',$channel_name))."</h3>
                            <h3 class=\"playlist-search\" title=\"".ucwords(str_replace('_', ' ', $playlist))."\">".strtoupper(str_replace('_', ' ', $playlist))."</h3>
                            <h3 class=\"genre-search\" title=\"".ucwords(str_replace('_', ' ', $genre))."\">".strtoupper(str_replace('_', ' ', $genre))."</h3>
                            <p class=\"podcast-streams-search\">".$streams." STREAMS</p>
                        </div>
                        </button>";
                    }
                    echo "</div>
                    </div>";
                } else {
                    echo "<div id=\"podcasts-container\">
                        <h4>PODCASTS</h4>
                        </div>
                    <div id=\"default-search\">
                        <h1 id=\"empty-search\">Sorry, no results found.</h1>
                    </div>";
                }
            }
            mysqli_stmt_close($stmt_podcasts);
            mysqli_close($conn);
        }  else {
            echo "<div id=\"default-search\">
                <h1 id=\"empty-search\">Sorry, no results found.</h1>
            </div>";
        }
    }

?>

<script src="./load_audio.js"></script>
<script src="./change_content.js"></script>
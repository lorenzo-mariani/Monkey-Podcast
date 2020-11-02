<?php

    if(isset($_GET['search'])){

        require 'dbh.inc.php';
        
        $search_text = strtolower(str_replace(" ", "_", $_GET['search']));

        if($search_text != ''){
            $query_users = "SELECT * FROM channels WHERE
                        channelName LIKE CONCAT('%', ?, '%')";
            $query_podcasts = "SELECT * from podcasts WHERE
                            userUID LIKE CONCAT('%', ?, '%')
                            OR podcastTitle LIKE CONCAT('%', ?, '%')
                            OR genre LIKE CONCAT('%', ?, '%')
                            OR playlist LIKE CONCAT('%', ?, '%')
                            ORDER BY podcastTitle ASC";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query_podcasts)) {
                header("Location: ./home.php?error=sqlerror");
                exit();
            } else {
            mysqli_stmt_bind_param($stmt, "ssss", $search_text, $search_text, $search_text, $search_text);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $stmt->bind_result($genre, $title, $img, $channel_name, $streams, $file, $playlist);
            if($stmt->num_rows > 0){
                echo "
                <div id=\"podcasts-container\">
                    <h4>PODCASTS</h4>
                </div>
                <div id=\"podcast-search\">
                    <div id=\"podcast-left-container-search\">
                    ";
                $count = 0;
                while($stmt->fetch()){
                    $count = $count + 1;
                    if($count != 4 && $count < 7){
                        echo 
                        "<div class=\"grid-element\" id=".$file.">
                            <img src=".str_replace('../', './', $img).">
                            <h4 id=".$channel_name.">".strtoupper(str_replace('_', ' ', $title))."</h4>
                            <p>".$streams." STREAMS</p>
                            <h3 id=\"channel-name-search\">".strtoupper($channel_name)."</h3>
                        </div>";
                    } else if($count == 4){
                        echo "</div>
                        <div id=\"podcast-right-container-search\">
                        <div class=\"grid-element\" id=".$file.">
                            <img src=".str_replace('../', './', $img).">
                            <h4 id=".$channel_name.">".strtoupper(str_replace('_', ' ', $title))."</h4>
                            <p>".$streams." STREAMS</p>
                            <h3 id=\"channel-name-search\">".strtoupper($channel_name)."</h3>
                        </div>";
                    } else if($count > 7){
                        echo "</div>";
                    }
                }
                echo "</div>
                </div>
                <p id=\"show-more\">SHOW MORE";
            }
            if (!mysqli_stmt_prepare($stmt, $query_users)) {
                header("Location: ./home.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $search_text);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $stmt->bind_result($name, $views, $ch_img);
                if($stmt->num_rows > 0){
                    echo "
                    <div id=\"users-container\">USERS</h4>
                    </div>
                        <div id=\"scrollchannel\">
                        ";
                    while($stmt->fetch()){
                        if($ch_img != ''){
                            echo 
                            "   <div class=\"grid-element-users\">
                                <img src=".str_replace('../', './', $ch_img).">
                                <h4>".strtoupper($name)."</h4>
                                <p>".$views." STREAMS</p>
                                </div>";
                        } else {
                            echo 
                            "   <div class=\"grid-element-users\">
                                <img>
                                <h4>".strtoupper($name)."</h4>
                                <p>".$views." STREAMS</p>
                                </div>";
                        }
                    }
                    echo "</div>";
                } else {
                    echo "<div id=\"default-search\">
                        <h1 id=\"empty-search\">Sorry, no results found.</h1>
                    </div>";
                }
                }
            }
            mysqli_stmt_close($stmt);
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
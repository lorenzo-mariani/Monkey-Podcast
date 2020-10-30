<?php
        require './dbh.inc.php';
        
        session_start();

        if(isset($_GET['playlist'])){
            $plst = $_GET['playlist'];
            $query = "SELECT * from podcasts WHERE
                        userUID = ?
                        AND playlist = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("Location: ./playlist_settings.inc.php?error=sqlerror");
                exit();
            } else {
            mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userUid'], $plst);
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
                            <img src=".$img.">
                            <h4 id=".$channel_name.">".strtoupper(str_replace('_', ' ', $title))."</h4>
                            <p>".$streams." STREAMS</p>
                            <h3 id=\"channel-name-search\">".strtoupper($channel_name)."</h3>
                        </div>";
                    } else if($count == 4){
                        echo "</div>
                        <div id=\"podcast-right-container-search\">
                        <div class=\"grid-element\" id=".$file.">
                            <img src=".$img.">
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

            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
?>

<script src="../change_content.js"></script>
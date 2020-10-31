<?php
    require './includes/dbh.inc.php';
    
    session_start();

    if(isset($_SESSION['userUid'])) {
        if(isset($_GET['title'])){
            $title = $_GET['title'];
            $query = "SELECT * from podcasts WHERE
                        userUID = ?
                        AND podcastTitle = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("Location: ./podcast_settings.php?error=sqlerror");
                exit();
            } else {
            mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userUid'], $title);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $stmt->bind_result($genre, $title, $img, $channel_name, $streams, $file, $playlist);
            if($stmt->num_rows > 0){
                echo "
                <div id=\"podcast-container\">";
                while($stmt->fetch()){
                    echo 
                    "<div class=\"grid-element-mod\" id=".$file.">
                        <img src=".$img.">
                        <h4 id=".$channel_name.">".strtoupper(str_replace('_', ' ', $title))."</h4>
                        <p>".$streams." STREAMS</p>
                    </div>";
                }
            }

            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
?>

<script src="../change_content.js"></script>
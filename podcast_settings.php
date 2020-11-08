
<div id="settings-container">
    <?php
        require './includes/dbh.inc.php';
        
        session_start();

        if(isset($_SESSION['userUid'])) {
            if(isset($_GET['title'])){
                $title_mod = $_GET['title'];
                $query = "SELECT * from podcasts WHERE
                            userUID = ?
                            AND podcastTitle = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header("Location: ./podcast_settings.php?error=sqlerror");
                    exit();
                } else {
                mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userUid'], $title_mod);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $stmt->bind_result($genre, $title_res, $img, $channel_name, $streams, $file, $playlist);
                if($stmt->num_rows > 0){
                    echo "
                    <div id=\"podcast-container\">";
                    while($stmt->fetch()){
                        echo 
                        "<div class=\"grid-element-mod\" id=".$file.">
                            <img src=".$img.">
                            <h4 id=".$channel_name.">".strtoupper(str_replace('_', ' ', $title_res))."</h4>
                            <p>".$streams." STREAMS</p>
                        </div>";
                    }
                }
                echo "</div>";
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
        }
    ?>

    <div id="form-settings-container">
        <form action="./includes/podsettings.inc.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Confirm your changes?')">
            <div id="img-upload-container">
                <label id="label-settings">Image File:</label>
                <input name="img-file-mod" id="img-file-settings" type="file" accept="image/*"/>
            </div>
            <h4 id="warning">Warning: max upload size 100MB.</h4>
            <input type="text" name="podcast-old-title"<?php echo "value=".$_GET['title'].""?> style="display: none;">
            <input id="podcast-title-settings" type="text" name="podcast-title-mod" placeholder="Choose the title" required>
            <input id="podcast-playlist-settings" type="text" name="podcast-playlist-mod" placeholder="Type playlist name" required>
            <h4 id="warning2">Warning: special characters like "\/:*?"<>|" are not valid.</h4>
            <select id="genre-menu-settings" name="genre-value-mod">  
                <option value="Select Genre">Select genre</option>
                <option value="Cinema">Cinema</option>  
                <option value="Culture">Culture</option>
                <option value="Entertainment">Entertainment</option>   
                <option value="Fashion">Fashion</option>
                <option value="Music">Music</option>
                <option value="Sport">Sport</option>
                <option value="Technology">Technology</option>
            </select>
            <button id="upload-submit-settings" type="submit" name="upload-submit">Sumbit</button>
        </form>
    </div>
</div>

<script src="../change_content.js"></script>
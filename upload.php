<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: ./index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload</title>
        <link rel="stylesheet" href="./css/uploadstyle.css" type="text/css">
        <?php
            if(isset($_COOKIE['mode'])){
                if($_COOKIE['mode'] == "dark"){
                    echo "<link rel=\"stylesheet\" href=\"./css/uploadstyledark.css\" type=\"text/css\">";
                } else if($_COOKIE['mode'] == "light") {
                    echo "<link rel=\"stylesheet\" href=\"./css/uploadstylelight.css\" type=\"text/css\">";
                }
            } else {
                echo "<link rel=\"stylesheet\" href=\"./css/uploadstyledark.css\" type=\"text/css\">";
            }
        ?>
    </head>
    <body>
        <div id="content">
            <div id="form-container">
                <form action= "./home.php" method="post">
                    <button id="logo-button" type="submit" name="logo-submit"
                    <?php
                        if(isset($_COOKIE['mode'])){
                            if($_COOKIE['mode'] == "dark"){
                                echo "value=\"dark\"";
                            } else if($_COOKIE['mode'] == "light") {
                                echo "value=\"light\"";
                            }
                        } else {
                            echo "value=\"dark\"";
                        }
                    ?>>
                        <img 
                        <?php
                            if(isset($_COOKIE['mode'])){
                                if($_COOKIE['mode'] == "dark"){
                                    echo "src='./img/logo/MonkeyPodcastLogo_dark.png'";
                                } else if($_COOKIE['mode'] == "light") {
                                    echo "src='./img/logo/MonkeyPodcastLogo_light.png'";
                                }
                            } else {
                                echo "src='./img/logo/MonkeyPodcastLogo_dark.png'";
                            }
                        ?> id='logo' alt='Monkey Podcast' tabindex="1">
                    </button>
                </form>
                <form action="./includes/upload.inc.php" method="post" enctype="multipart/form-data">
                    <label>Audio File:</label>
                    <input name="audio-file" id="audio-file" type="file" accept="audio/*"/>
                    <label>Image File:</label>
                    <input name="img-file" id="img-file" type="file" accept="image/*"/>
                    <input id="podcast-title" type="text" name="podcast-title" placeholder="Choose the title">
                    <input id="podcast-playlist" type="text" name="podcast-playlist" placeholder="Type playlist name">
                    <select id="genre-menu" name="genre-value">  
                        <option value="Select Genre">Select genre</option>
                        <option value="Cinema">Cinema</option>  
                        <option value="Culture">Culture</option>
                        <option value="Entertainment">Entertainment</option>   
                        <option value="Fashion">Fashion</option>
                        <option value="Music">Music</option>
                        <option value="Sport">Sport</option>
                        <option value="Technology">Technology</option>
                    </select>
                    <button id="upload-submit" type="submit" name="upload-submit">Upload</button>
                </form>
            </div>
        </div>
    </body>
</html>
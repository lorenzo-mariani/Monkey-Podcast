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
                <form action="./includes/upload.inc.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you shure you want to upload this podcast?')">
                    <label>Audio File:</label>
                    <input name="audio-file" id="audio-file" type="file" accept="audio/mp3"/>
                    <label>Image File:</label>
                    <input name="img-file" id="img-file" type="file" accept="image/*"/>
                    <h4 id="warning">Warning: max upload size 100MB.</h4>
                    <input id="podcast-title" type="text" name="podcast-title" placeholder="Choose the title" required>
                    <input id="podcast-playlist" type="text" name="podcast-playlist" placeholder="Type playlist name" required>
                    <h4 id="warning2">Warning: special characters like "\/:*?"<>|" are not valid.</h4>
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
                    <button id="upload-submit" type="submit" name="upload-submit">UPLOAD</button>
                </form>
            </div>

            <div id="error-msg" <?php
                if(isset($_GET['error'])){
                    echo "style=\"display: grid;\"";
                } else {
                    echo "style=\"display: none\"";
                }
                ?>>
                <div id="error-text-container">
                    <h4 id="error-text">
                    <?php
                        if(isset($_GET['error'])){
                            if($_GET['error'] == "invalidtitle"){
                                echo "Sorry, the title you have typed is not valid.";
                            } else if($_GET['error'] == "podcastexists"){
                                echo "This podcast already exists.";
                            } else if($_GET['error'] == "sqlerror"){
                                echo "There was an error on the backend side.";
                            } else if($_GET['error'] == "emptytitle"){
                                echo "Please, choose a title.";
                            } else if($_GET['error'] == "emptygenre"){
                                echo "Please, select a genre.";
                            } else if($_GET['error'] == "emptyplaylist"){
                                echo "Please, choose a playlist.";
                            } else if($_GET['error'] == "audioerror"){
                                echo "There was an error while uploading your audio file.";
                            } else if($_GET['error'] == "imgerror"){
                                echo "There was an error while uploading your image file.";
                            }
                        }
                    ?>
                    </h4>
                    <button id="ok-button" type="button" onclick="document.getElementById('error-msg').style.display = 'none'">OK</button>
                </div>
            </div>
        </div>
    </body>
</html>
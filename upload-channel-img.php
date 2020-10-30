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
        <title>Upload Channel Img</title>
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
                    <button id="logo-button" type="submit" name="logo-submit">
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
                        ?> id='logo' alt='Monkey Podcast'>
                    </button>
                </form>
                <form action="./includes/upload-img.inc.php" method="post" enctype="multipart/form-data">
                    <label>Image File:</label>
                    <input name="img-file" id="img-file" type="file" accept="image/*"/>
                    <button id="upload-submit-ch" type="submit" name="channel-img-submit">Upload</button>
                </form>
            </div>
        </div>
    </body>
</html>
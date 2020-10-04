<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: ../../../../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload</title>
        <link rel="stylesheet" href="../../../../css/uploadstyle.css" type="text/css">
    </head>
    <body>
        <div class="modal-content">
            <div class="close">+</div>
            <form action= "../../../../home.php" method="post">
                <button id="logo-button" type="submit" name="logo-submit">
                    <img src='../../../../img/logo/MonkeyPodcastLogo_dark.png' id='logo' alt='Monkey Podcast'>
                </button>
            </form>
            <form action="../../../../includes/upload.inc.php" method="post" enctype="multipart/form-data">
                <label>Audio File:</label>
                <input name="audio-file" id="audio-file" type="file" accept="audio/*"/>
                <label>Image File:</label>
                <input name="img-file" id="img-file" type="file" accept="image/*"/>
                <input id="podcast-title" type="text" name="podcast-title" placeholder="Choose the title">
                <select id="genre-menu" name="genre-value">  
                    <option value="Select Genre">Select genre</option>}  
                    <option value="Rock">Rock</option>  
                    <option value="Pop">Pop</option>  
                    <option value="Metal">Metal</option>
                </select>
                <button id="upload-submit" type="submit" name="upload-submit">Upload</button>
            </form>
        </div>
    </body>
</html>
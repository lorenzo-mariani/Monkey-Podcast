<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: ./index.php");
    }

    require "./includes/dbh.inc.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/homestyle.css" type="text/css">
    <link id="style" rel="stylesheet" href="css/homestyledark.css" type="text/css">
    <title>Home</title>
</head>
<body>
    <header>
        <div class="header">
            <div class="logo-container">
                <img src='img/logo/MonkeyPodcastLogo_dark.png' id='logo' alt='Monkey Podcast'>
            </div>
            <div class="search-container">
                <input id="search-bar" type="text" placeholder="Search..">
                <img src="icon/search.png" alt="Search Button" id="search-icon">
            </div>
            <div class="icons-container">
                <h4 id="mode-text">DARK MODE ON</h4>
                <label id="mode-switch">
                    <input id="checkbox" type="checkbox" name="toggled-mode-home" value="dark" checked>
                    <span class="slider round"></span>
                </label>
                <form action=<?php 
                    $str = "content/users/".$_SESSION["userUid"]."/podcasts/upload.php";
                    echo $str;
                ?> method="post">
                    <button class="upload-button" type="submit" name="logo-submit">
                        <img src="icon/microphone.png" alt="Upload Podcast" id="upload-icon">
                    </button>
                </form>
                <img src="icon/user.png" alt="User Profile" id="profile-icon">
            </div>
            <div id="profile-menu">
                <form action= <?php
                $str = "content/users/".$_SESSION["userUid"]."/".$_SESSION["userUid"].".php";
                echo $str;
                ?>  method="post"> 
                    <button class="active" id="profile-button" type="submit" name="profile-submit">
                    <?php
                        $string = $_SESSION["userUid"];
                        $uid = strtoupper($string);
                        echo $uid;
                    ?>
                    </button>
                </form>
                <form action="includes/logout.inc.php" method="post">
                    <button id="logout-button" type="submit" name="logout-submit">LOGOUT</button>
                </form>
            </div>
        </div>
    </header>
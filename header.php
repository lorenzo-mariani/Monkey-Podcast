<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: ./index.php");
    }
    require "./includes/dbh.inc.php";

    if(!isset($_COOKIE['mode'])) {
        setcookie('mode', 'dark', time() + (86400 * 30), "/");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/searchstyle.css" type="text/css">
    <link id="search-style" rel="stylesheet" href="./css/searchstyledark.css" type="text/css">
    <link rel="stylesheet" href="./css/homestyle.css" type="text/css">
    <link id="home-style" rel="stylesheet" href="./css/homestyledark.css" type="text/css">
    <link rel="stylesheet" href="./css/profilestyle.css" type="text/css">
    <link id="profile-style" rel="stylesheet" href="./css/profilestyledark.css" type="text/css">
    <title>Home</title>
</head>
<body>
    <header>
        <div id="header">
            <div id="logo-container">
                <div id="history-btns-container">
                    <button id="history-back-btn">
                        <img src='icon/arrow.png' id='left-arrow-hist' alt='left-history-arrow'>
                    </button>
                    <button id="history-forw-btn">
                        <img src='icon/arrow.png' id='right-arrow-hist' alt='right-history-arrow'>
                    </button>
                </div>
                <button id="logo-btn">
                    <img src='img/logo/MonkeyPodcastLogo_dark.png' id='logo' alt='Monkey Podcast'>
                </button>
                <button id="display-more-btn">
                    <img src='./icon/arrow.png' id="display-more">
                </button>
            </div>
            <div id="search-container">
                <input id="search-bar" type="text" placeholder="Search..">
                <div id="speech-container">
                    <input id="speech-check" type="checkbox" name="speech-rec-check" style="display: none;">
                    <button id="speech-icon-btn"> 
                        <img src="./icon/voice.png" alt="Voice Commands Button" id="speech-icon">
                    </button>
                </div>
                <button id="search-icon-btn">
                    <img src="icon/search.png" alt="Search Button" id="search-icon">
                </button>
            </div>
            <div id="icons-container">
                <h4 id="mode-text">DARK MODE ON</h4>
                <label id="mode-switch">
                    <input id="checkbox" type="checkbox" name="toggled-mode-home" value="dark"
                    onclick="if(this.getAttribute('value') == 'dark'){
                            setCookie('mode', 'light', 2);
                        } else if(this.getAttribute('value') == 'light'){
                            setCookie('mode', 'dark', 2);
                        }"
                        checked>
                    <span class="slider round" ></span>
                </label>
                <form action="./upload.php" method="post">
                    <button id="upload-icon-btn" type="submit" name="logo-submit">
                        <img src="./icon/microphone.png" alt="Upload Podcast" id="upload-icon">
                    </button>
                </form>
                <button id="profile-icon-btn">
                    <img src="./icon/user.png" alt="User Profile" id="profile-icon">
                </button>
            </div>
            <div id="profile-menu" style="display: none;">
                <button id="profile-btn">
                    <h4 id="profile-button"><?php
                        $string = $_SESSION["userUid"];
                        $uid = strtoupper($string);
                        echo $uid;
                    ?></h4>
                </button>
                <button id="help-btn">
                    <h4 id="help-button">HELP</h4>
                </button>
                <form action="includes/logout.inc.php" method="post" onsubmit="return confirm('Are you shure you want to logout?');">
                    <button id="logout-button" type="submit" name="logout-submit">LOGOUT</button>
                </form>
            </div>
        </div>
    </header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./change_content.js"></script>
    <script src="./home.js"></script>
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
<body onload="if(getCookie('memaudio') != '' && getCookie('memaudio').split('&')[0].substring('audio='.length, getCookie('memaudio').split('&')[0].length)  != 'undefined'){
    setAudio('memaudio');
    } 
    if(getCookie('mode') == 'light'){
        document.getElementById('checkbox').click();
    }">
    <header>
        <div id="header">
            <div id="logo-container">
                <img src='img/logo/MonkeyPodcastLogo_dark.png' id='logo' alt='Monkey Podcast' tabindex="1">
            </div>
            <div id="search-container">
                <input id="search-bar" type="text" placeholder="Search.." tabindex="2">
                <div id="speech-container">
                    <input id="speech-check" type="checkbox" name="speech-rec-check" style="display: none;">
                    <img src="./icon/voice.png" alt="Voice Commands Button" id="speech-icon" tabindex="3">
                </div>
                <img src="icon/search.png" alt="Search Button" id="search-icon" tabindex="4">
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
                    <span class="slider round" tabindex="5"></span>
                </label>
                <form action="./upload.php" method="post">
                    <button id="upload-button" type="submit" name="logo-submit">
                        <img src="./icon/microphone.png" alt="Upload Podcast" id="upload-icon" tabindex="6">
                    </button>
                </form>
                <img src="./icon/user.png" alt="User Profile" id="profile-icon" tabindex="7">
            </div>
            <div id="profile-menu" style="display: none;">
                <h4 id="profile-button" tabindex="7"><?php
                    $string = $_SESSION["userUid"];
                    $uid = strtoupper($string);
                    echo $uid;
                ?></h4>
                <h4 id="help-button" tabindex="8">HELP</h4>
                <form action="includes/logout.inc.php" method="post" onsubmit="return confirm('Are you shure you want to logout?');">
                    <button id="logout-button" type="submit" name="logout-submit" tabindex="9">LOGOUT</button>
                </form>
            </div>
        </div>
    </header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./change_content.js"></script>
    <script src="./home.js"></script>
<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: ../../../index.php");
    }
    if(!isset($_SESSION['channelName'])){
        $_SESSION['channelName'] = basename(__FILE__, '.php');
    } else if($_SESSION['channelName'] != basename(__FILE__, '.php')){
        $_SESSION['channelName'] = basename(__FILE__, '.php');
    }
    
    require "../../../includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="style" rel="stylesheet" href="../../../css/profilestyledark.css"> 
    <title>Profile</title>
</head>
<body>
    <header>
        <div class="header">
            <div class="logo-container">
            <form action= "../../../home.php" method="post">
                <button id="logo-button" type="submit" name="logo-submit">
                    <img src='../../../img/logo/MonkeyPodcastLogo_dark.png' id='logo' alt='Monkey Podcast'>
                </button>
            </form>
            </div>
            <div class="search-container">
                <input id="search-bar" type="text" placeholder="Search..">
                <img src="../../../icon/search.png" alt="Search Button" id="search-icon">
            </div>
            <div class="icons-container">
                <h4 id="mode-text">DARK MODE ON</h4>
                <label id="mode-switch">
                    <input id="checkbox" type="checkbox" name="toggled-mode" value="dark" checked>
                    <span class="slider round"></span>
                </label>
                <form action=
                    <?php
                     echo "../../../content/users/".$_SESSION["userUid"]."/podcasts/upload.php" 
                    ?>
                    method="post">
                    <button class="upload-button" type="submit" name="logo-submit">
                        <img src="../../../icon/microphone.png" alt="Upload Podcast" id="upload-icon">
                    </button>
                </form>
                <img src="../../../icon/user.png" alt="User Profile" id="profile-icon">
            </div>
            <div id="profile-menu">
            <form action=<?php 
                echo "../../../content/users/".$_SESSION["userUid"]."/".$_SESSION["userUid"].".php";
            ?> method="post"> 
                    <button class="active" id="profile-button" type="submit" name="profile-submit">
                    <?php
                        $string = $_SESSION["userUid"];
                        $uid = strtoupper($string);
                        echo $uid;
                    ?>
                    </button>
                </form>
                <form action="../../../includes/logout.inc.php" method="post">
                    <button id="logout-button" type="submit" name="logout-submit">LOGOUT</button>
                </form>
            </div>
        </div>
    </header>
    <div class="content">
        <div class="tabs-container">
            <ul class="tabs-menu">
                <li id="home">HOME</li>
                <li id="channels">CHANNELS</li>
            </ul>
        </div>
        <div class="info-container"
        <?php
        $query = "SELECT channelImg FROM channels WHERE channelName=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("Location: ./feffo.php?error=sqerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['channelName']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $stmt->bind_result($podcast_img);
            while($stmt->fetch()){
                echo "style=\"background-image:url('".str_replace("../content/users/".$_SESSION['channelName']."/", "./",$podcast_img)."')\"";
            }
            mysqli_stmt_close($stmt);
        }
        ?>>
            <div class="left-column">
                <img src="../../../icon/user.png" alt="User Profile" id="profile-img">
                <ul class="info">
                    <li id="username">
                        <?php
                            echo strtoupper(basename(__FILE__, '.php'));
                        ?>
                    </li>
                    <br>
                    <li id="subs">
                        <?php
                            $query = "SELECT  subs FROM users WHERE uidUsers=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $query)) {
                                header("Location: ./feffo.php?error=sqerror");
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $_SESSION['channelName']);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_store_result($stmt);
                                $stmt->bind_result($subs);
                                $result_check = mysqli_stmt_num_rows($stmt);
                                if($result_check > 0) {
                                    while($stmt->fetch()){
                                        echo $subs;
                                    }
                                } else {
                                    echo $result_check;
                                }
                            }
                            mysqli_stmt_close($stmt);
                        ?>
                    </li>
                </ul>
            </div>
            <div class="right-column">
                <br>
                <h3>DESCRIPTION</h3>
                <br>
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <?php
                    if($_SESSION['userUid'] != basename(__FILE__, '.php')){

                        $query = "SELECT channelName FROM subscriptions WHERE subUid=? && channelName=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $query)) {
                            header("Location: ./prova.php?error=sqerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userUid'], $_SESSION['channelName']);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                            $resultCheck = mysqli_stmt_num_rows($stmt);
                            if($resultCheck == 0) {
                                echo
                                "<form action=\"../../../includes/subscribe.inc.php\" method=\"post\">
                                    <button id=\"subscribe-button\" type=\"submit\" name=\"logo-submit\">
                                        SUBSCRIBE
                                    </button>
                                </form>";
                            } else if($resultCheck == 1){
                                echo
                                "<h3 id=\"subscribed\">SUBSCRIBED</h3>";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                ?>
            </div>
        </div>
        <div class="views-container">
            <h3>123.456.789 views</h3>
        </div>
        <div class="podcasts-container">
            <?php

                $query = "SELECT podcastTitle, podcastImg, podcastViews, podcastFile FROM podcasts WHERE userUID=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header("Location: ./prova.php?error=sqerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['channelName']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $stmt->bind_result($title, $podcast_img, $streams, $podcast_file);
                    $channel_name = $_SESSION['channelName'];
                    while($stmt->fetch()){
                        echo
                        "<div class=\"grid-element\">
                            <a href=../../../player.php?file=".str_replace("../", "/Monkey-Podcast/",$podcast_file)."&title=".$title."&img=".str_replace("../", "/Monkey-Podcast/",$podcast_img)."&channel-name=".$channel_name." target=\"_blank\">
                                <img src=".str_replace("../", "/Monkey-Podcast/", $podcast_img)." alt=\"Sample1\">
                            </a>
                            <a href=../../../player.php?file=".str_replace("../", "/Monkey-Podcast/",$podcast_file)."&title=".$title."&img=".str_replace("../", "/Monkey-Podcast/",$podcast_img)."&channel-name=".$channel_name." target=\"_blank\">
                                <h4>".strtoupper(str_replace('_', ' ', $title))."</h4>
                            </a>
                            <p>".$streams."</p>
                        </div>";
                    }
                }
                mysqli_stmt_close($stmt);
            ?>
        </div>
        <div class="channels-container">
        <?php
                $query = "SELECT channelName, subs
                FROM (SELECT channelName, subUid FROM subscriptions as sub
                INNER JOIN 
                users as u1
                ON sub.subUid = u1.uidUsers) as t1
                INNER JOIN
                users as u2
                ON t1.channelName = u2.uidUsers
                WHERE subUid=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header("Location: ./prova.php?error=sqerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['channelName']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $stmt->bind_result($channel_name, $subs);
                    $result_check = mysqli_stmt_num_rows($stmt);
                    if($result_check > 0) {
                        while($stmt->fetch()){
                            echo
                            "
                            <div class=\"channel\">
                                <form action=\"../".$channel_name."/".$channel_name.".php\" method=\"post\">
                                    <button id=\"channel-button\" type=\"submit\" name=\"channel-submit\">
                                        <img src=\"../../../icon/user.png\" alt=\"User Profile\" id=\"channel-img\">
                                    </button>
                                    <ul class=\"channel-info\">
                                        <li id=\"channel-name\">".$channel_name."</li>
                                        <li id=\"channel-subs\">".$subs."</li>
                                    </ul>
                                </form>
                            </div>
                            ";
                        }
                    } else {
                        echo $result_check;
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            ?>
        </div>
    </div>
    <script src=<?php 
                echo basename(__FILE__, '.php').".js";
            ?>></script>
</body>
</html>
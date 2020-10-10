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
        <div class="info-container">
            <div class="left-column">
                <img src="../../../icon/user.png" alt="User Profile" id="profile-img">
                <ul class="info">
                    <li id="username">
                        <?php
                            echo strtoupper(basename(__FILE__, '.php'));
                        ?>
                    </li>
                    <br>
                    <li id="subs"># SUBS</li>
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
                                    <button class=\"subscribe-button\" type=\"submit\" name=\"logo-submit\">
                                        SUBSCRIBE
                                    </button>
                                </form>";
                            } else if($resultCheck == 1){
                                echo
                                "<h3>SUBSCRIBED</h3>";
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
            <div class="grid-element">
                <img src="../../../img/thumbnails/Sample1.jpg" alt="Sample1">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
        </div>
        <div class="channels-container">
        <?php
                $query = "SELECT channelName, subs FROM subscriptions INNER JOIN users ON subUid=uidUsers  WHERE subUid=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header("Location: ./prova.php?error=sqerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['userUid']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $stmt->bind_result($channel_name, $subs);
                    $result_check = mysqli_stmt_num_rows($stmt);
                    if($result_check > 0) {
                        while($stmt->fetch()){
                            echo
                            "
                            <div class=\"channel\">
                                <img src=\"../../../icon/user.png\" alt=\"User Profile\" id=\"channel-img\">
                                <ul class=\"channel-info\">
                                    <li id=\"channel-name\">".$channel_name."</li>
                                    <li id=\"channel-subs\">".$subs."</li>
                                </ul>
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
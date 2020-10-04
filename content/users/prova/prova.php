<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: ../../../index.php");
    }
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
                <h4 id="mode-text">DARK MODE OFF</h4>
                <label id="mode-switch">
                    <input id="checkbox" type="checkbox" name="toggled-mode" value="light" checked>
                    <span class="slider round"></span>
                </label>
                <form action="./podcasts/upload.php" method="post">
                    <button class="upload-button" type="submit" name="logo-submit">
                        <img src="../../../icon/microphone.png" alt="Upload Podcast" id="upload-icon">
                    </button>
                </form>
                <img src="../../../icon/user.png" alt="User Profile" id="profile-icon">
            </div>
            <div id="profile-menu">
            <form action=<?php 
                echo $_SESSION["userUid"].".php";
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
                    <li id="username">USERNAME</li>
                    <br>
                    <li id="subs"># SUBS</li>
                </ul>
            </div>
            <div class="right-column">
                <br>
                <h3>DESCRIPTION</h3>
                <br>
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
            <div class="grid-element">
                <img src="../../../img/thumbnails/Sample3.jpg" alt="Sample3">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="../../../img/thumbnails/Sample4.jpg" alt="Sample4">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="../../../img/thumbnails/Sample5.jpg" alt="Sample5">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="../../../img/thumbnails/Sample6.jpg" alt="Sample6">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="../../../img/thumbnails/Sample1.jpg" alt="Sample1">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="../../../img/thumbnails/Sample3.jpg" alt="Sample3">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="../../../img/thumbnails/Sample4.jpg" alt="Sample4">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="../../../img/thumbnails/Sample5.jpg" alt="Sample5">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="../../../img/thumbnails/Sample6.jpg" alt="Sample6">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="../../../img/thumbnails/Sample1.jpg" alt="Sample1">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="../../../img/thumbnails/Sample3.jpg" alt="Sample3">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="../../../img/thumbnails/Sample4.jpg" alt="Sample4">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="../../../img/thumbnails/Sample5.jpg" alt="Sample5">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="../../../img/thumbnails/Sample6.jpg" alt="Sample6">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="../../../img/thumbnails/Sample1.jpg" alt="Sample1">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="../../../img/thumbnails/Sample3.jpg" alt="Sample3">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
        </div>
        <div class="channels-container">
           <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
            <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
            <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
            <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
            <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
            <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
            <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
            <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
            <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
            <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
            <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
            <div class="channel">
                <img src="../../../icon/user.png" alt="User Profile" id="channel-img">
                <ul class="channel-info">
                    <li id="channel-name">USERNAME</li>
                    <li id="channel-subs"># SUBS</li>
                </ul>
            </div>
        </div>
    </div>
    <script src=<?php 
                echo $_SESSION["userUid"].".js";
            ?>></script>
</body>
</html>    
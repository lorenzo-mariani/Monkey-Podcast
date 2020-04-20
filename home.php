<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: ./index.php");
    }
?>

<style>
<?php include 'css/homestyledark.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <header>
        <div class="header">
            <div class="logo-container">
                <img src="img/logo/MonkeyPodcastLogo_dark.png" id="logo" alt="Monkey Podcast">
            </div>
            <div class="search-container">
                <input id="search-bar" type="text" placeholder="Search..">
                <img src="icon/search.png" alt="Search Button" id="search-icon">
            </div>
            <div class="icons-container">
                <img src="icon/microphone.png" alt="Upload Podcast" id="upload-icon">
                <img src="icon/user.png" alt="User Profile" id="profile-icon">
            </div>
            <div id="profile-menu">
                <form action="includes/logout.inc.php" method="post">
                    <button class="active" id="profile-button" type="submit" name="profile-submit">Profile</button>
                    <button id="channel-button" type="submit" name="channel-submit">Channel</button>
                    <button id="podcasts-button" type="submit" name="podcasts-submit">My podcasts</button>
                    <button id="logout-button" type="submit" name="logout-submit">LOGOUT</button>
                </form>
            </div>
        </div>
    </header>
    <div class="content">
        <div class="scrollchannel">
            <img class="left-scroll-arrow" src="icon/arrow.png" alt="Left Arrow">
            <img class="right-scroll-arrow" src="icon/arrow.png" alt="Right Arrow">
            <h2 id="channel-name">CHANNEL NAME</h2>
            <div class="grid-element">
                <img src="img/thumbnails/Sample1.jpg" alt="Sample1">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="img/thumbnails/Sample2.jpg" alt="Sample2">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample3.jpg" alt="Sample3">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample4.jpg" alt="Sample4">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample5.jpg" alt="Sample5">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="img/thumbnails/Sample6.jpg" alt="Sample6">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
        </div>
        <div class="scrollchannel">
        <img class="left-scroll-arrow" src="icon/arrow.png" alt="Left Arrow">
        <img class="right-scroll-arrow" src="icon/arrow.png" alt="Right Arrow">
        <h2 id="channel-name">CHANNEL NAME</h2>
        <div class="grid-element">
                <img src="img/thumbnails/Sample1.jpg" alt="Sample1">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="img/thumbnails/Sample2.jpg" alt="Sample2">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample3.jpg" alt="Sample3">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample4.jpg" alt="Sample4">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample5.jpg" alt="Sample5">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="img/thumbnails/Sample6.jpg" alt="Sample6">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
        </div>
        <div class="scrollchannel">
        <img class="left-scroll-arrow" src="icon/arrow.png" alt="Left Arrow">
        <img class="right-scroll-arrow" src="icon/arrow.png" alt="Right Arrow">
        <h2 id="channel-name">CHANNEL NAME</h2>
        <div class="grid-element">
                <img src="img/thumbnails/Sample1.jpg" alt="Sample1">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="img/thumbnails/Sample2.jpg" alt="Sample2">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample3.jpg" alt="Sample3">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample4.jpg" alt="Sample4">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample5.jpg" alt="Sample5">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="img/thumbnails/Sample6.jpg" alt="Sample6">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
        </div>
        <div class="scrollchannel">
        <img class="left-scroll-arrow" src="icon/arrow.png" alt="Left Arrow">
        <img class="right-scroll-arrow" src="icon/arrow.png" alt="Right Arrow">
        <h2 id="channel-name">CHANNEL NAME</h2>
            <div class="grid-element">
                <img src="img/thumbnails/Sample1.jpg" alt="Sample1">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="img/thumbnails/Sample2.jpg" alt="Sample2">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample3.jpg" alt="Sample3">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample4.jpg" alt="Sample4">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>    <div class="grid-element">
                <img src="img/thumbnails/Sample5.jpg" alt="Sample5">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
            <div class="grid-element">
                <img src="img/thumbnails/Sample6.jpg" alt="Sample6">
                <h4>PODCAST TITLE</h4>
                <p>1000 streams</p>
            </div>
        </div>
    </div>

    <script src="home.js"></script>
</body>
</html>
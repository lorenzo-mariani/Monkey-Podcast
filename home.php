<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: ./index.php");
    }
?>

<style>
<?php include 'css/homestylelight.css'; ?>
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
            <img src="img/logo/MonkeyPodcastLogo_light.png" id="logo" alt="Monkey Podcast">
            <input id="search-bar" type="text" placeholder="Search..">
            <?php
                echo '<input id="user-button" type="button" value="'.strtoupper($_SESSION['userUid']).'">';
            ?>
            <form action="includes/logout.inc.php" method="post">
                <button id="logout-button" type="submit" name="logout-submit">LOGOUT</button>
            </form>
            <img src="icon/user_dark.png" alt="User Profile" id="profile-icon">
        </div>
    </header>
    <div class="content">
        <div class="scrollchannel">
            <img class="left-scroll-arrow" src="icon/left-arrow.png" alt="Left Arrow">
            <img class="right-scroll-arrow" src="icon/left-arrow.png" alt="Right Arrow">
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
        <img class="left-scroll-arrow" src="icon/left-arrow.png" alt="Left Arrow">
        <img class="right-scroll-arrow" src="icon/left-arrow.png" alt="Right Arrow">
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
        <img class="left-scroll-arrow" src="icon/left-arrow.png" alt="Left Arrow">
        <img class="right-scroll-arrow" src="icon/left-arrow.png" alt="Right Arrow">
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
        <img class="left-scroll-arrow" src="icon/left-arrow.png" alt="Left Arrow">
        <img class="right-scroll-arrow" src="icon/left-arrow.png" alt="Right Arrow">
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
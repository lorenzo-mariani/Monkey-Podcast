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
                <h4 id="mode-text">DARK MODE OFF</h4>
                <label id="mode-switch">
                    <input id="checkbox" type="checkbox" name="toggled-mode" value="light" checked>
                    <span class="slider round"></span>
                </label>
                <img src="icon/microphone.png" alt="Upload Podcast" id="upload-icon">
                <img src="icon/user.png" alt="User Profile" id="profile-icon">
            </div>
            <div id="profile-menu">
                <form action="includes/logout.inc.php" method="post">
                    <button class="active" id="profile-button" type="submit" name="profile-submit">Profile</button>
                    <button id="logout-button" type="submit" name="logout-submit">LOGOUT</button>
                </form>
            </div>
        </div>
    </header>
    <div class="content">
         <div id="channel-name-container1">
            <h1 id="channel-name">SLIPKNOT</h1>
        </div>
        <div class="scrollchannel">
            <img class="left-scroll-arrow" src="icon/arrow.png" alt="Left Arrow">
            <img class="right-scroll-arrow" src="icon/arrow.png" alt="Right Arrow">
            <h2 id="album-name">ALL HOPE IS GONE</h2>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample1">
                <h4>.Execute</h4>
                <p>156542 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample2">
                <h4>Gematria (The Killing Name)</h4>
                <p>954612 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample3">
                <h4>Sulfur</h4>
                <p>516545 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample4">
                <h4>Psychosocial</h4>
                <p>5989519 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample5">
                <h4>Dead Memories</h4>
                <p>515198 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Vendetta</h4>
                <p>984651 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Butcher's Hook</h4>
                <p>9119515 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Gehenna</h4>
                <p>5135168 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>This Cold Black</h4>
                <p>651632 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Wherein Lies Continue</h4>
                <p>418494 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Snuff</h4>
                <p>416549 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>All Hope Is Gone</h4>
                <p>135465 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Child Of Burning Time</h4>
                <p>513546 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Vermillion Pt.2 (Bloodstone Mix)</h4>
                <p>832165 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>'Till We Die</h4>
                <p>651321 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Psychosocial [Live]</h4>
                <p>8912138 streams</p>
            </div>
        </div>
        <div class="scrollchannel">
            <img class="left-scroll-arrow" src="icon/arrow.png" alt="Left Arrow">
            <img class="right-scroll-arrow" src="icon/arrow.png" alt="Right Arrow">
            <h2 id="album-name">ALL HOPE IS GONE</h2>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample1">
                <h4>.Execute</h4>
                <p>156542 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample2">
                <h4>Gematria (The Killing Name)</h4>
                <p>954612 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample3">
                <h4>Sulfur</h4>
                <p>516545 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample4">
                <h4>Psychosocial</h4>
                <p>5989519 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample5">
                <h4>Dead Memories</h4>
                <p>515198 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Vendetta</h4>
                <p>984651 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Butcher's Hook</h4>
                <p>9119515 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Gehenna</h4>
                <p>5135168 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>This Cold Black</h4>
                <p>651632 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Wherein Lies Continue</h4>
                <p>418494 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Snuff</h4>
                <p>416549 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>All Hope Is Gone</h4>
                <p>135465 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Child Of Burning Time</h4>
                <p>513546 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Vermillion Pt.2 (Bloodstone Mix)</h4>
                <p>832165 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>'Till We Die</h4>
                <p>651321 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Psychosocial [Live]</h4>
                <p>8912138 streams</p>
            </div>
        </div>
        <div id="channel-name-container2">
            <h1 id="channel-name">SLIPKNOT</h1>
        </div>
        <div class="scrollchannel">
            <img class="left-scroll-arrow" src="icon/arrow.png" alt="Left Arrow">
            <img class="right-scroll-arrow" src="icon/arrow.png" alt="Right Arrow">
            <h2 id="album-name">ALL HOPE IS GONE</h2>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample1">
                <h4>.Execute</h4>
                <p>156542 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample2">
                <h4>Gematria (The Killing Name)</h4>
                <p>954612 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample3">
                <h4>Sulfur</h4>
                <p>516545 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample4">
                <h4>Psychosocial</h4>
                <p>5989519 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample5">
                <h4>Dead Memories</h4>
                <p>515198 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Vendetta</h4>
                <p>984651 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Butcher's Hook</h4>
                <p>9119515 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Gehenna</h4>
                <p>5135168 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>This Cold Black</h4>
                <p>651632 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Wherein Lies Continue</h4>
                <p>418494 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Snuff</h4>
                <p>416549 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>All Hope Is Gone</h4>
                <p>135465 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Child Of Burning Time</h4>
                <p>513546 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Vermillion Pt.2 (Bloodstone Mix)</h4>
                <p>832165 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>'Till We Die</h4>
                <p>651321 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Psychosocial [Live]</h4>
                <p>8912138 streams</p>
            </div>
        </div>
        <div class="scrollchannel">
            <img class="left-scroll-arrow" src="icon/arrow.png" alt="Left Arrow">
            <img class="right-scroll-arrow" src="icon/arrow.png" alt="Right Arrow">
            <h2 id="album-name">ALL HOPE IS GONE</h2>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample1">
                <h4>.Execute</h4>
                <p>156542 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample2">
                <h4>Gematria (The Killing Name)</h4>
                <p>954612 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample3">
                <h4>Sulfur</h4>
                <p>516545 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample4">
                <h4>Psychosocial</h4>
                <p>5989519 streams</p>
            </div>    <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample5">
                <h4>Dead Memories</h4>
                <p>515198 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Vendetta</h4>
                <p>984651 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Butcher's Hook</h4>
                <p>9119515 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Gehenna</h4>
                <p>5135168 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>This Cold Black</h4>
                <p>651632 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Wherein Lies Continue</h4>
                <p>418494 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Snuff</h4>
                <p>416549 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>All Hope Is Gone</h4>
                <p>135465 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Child Of Burning Time</h4>
                <p>513546 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Vermillion Pt.2 (Bloodstone Mix)</h4>
                <p>832165 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>'Till We Die</h4>
                <p>651321 streams</p>
            </div>
            <div class="grid-element">
                <img src="audio/Slipknot-All Hope Is Gone/Front cover.jpg" alt="Sample6">
                <h4>Psychosocial [Live]</h4>
                <p>8912138 streams</p>
            </div>
        </div>
    </div>

    <script src="home.js"></script>
</body>
</html>

<?php
    require "player.php";
?>
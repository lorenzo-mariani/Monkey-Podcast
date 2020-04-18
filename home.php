<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: ./index.php");
    }
?>

<style>
<?php include 'css/homestyle.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./homestyle.css" />
    <title>Home</title>
</head>
<body>
    <header>
        <div class="header">
            <img src="img/logo/MonkeyPodcastLogo.png" id="logo" alt="Monkey Podcast">
            <input id="search-bar" type="text" placeholder="Search..">
            <?php
                echo '<input id="user-button" type="button" value="'.strtoupper($_SESSION['userUid']).'">';
            ?>
            <form action="includes/logout.inc.php" method="post">
                <button id="logout-button" type="submit" name="logout-submit">Logout</button>
            </form>
            <img src="icons/user.png" id="profile-icon">
        </div>
    </header>
    <p id="recent">RECENT</p>
    <div class="content">
    </div>
</body>
</html>
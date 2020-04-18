<?php
    session_start();
    if(isset($_SESSION['userId'])){
        header("Location: ./home.php");
    }
?>


<style>
<?php include 'css/indexstyle.css'; ?>
</style>

<main>
    <div class="logo">
         <img src="img/logo/MonkeyPodcastLogo_vertical.png" id="logo">
    </div>
    <div class="main-content">
         <h1>
             LISTEN TO THE BEST PODCASTS ON THE INTERNET.
        </h1>
        <button id="login-button" type="button">Log In</button>
    </div>

    <div class="bg-modal">
        <div class="modal-content">
            <div class="close">+</div>
            <img id="form-logo" src="img/logo/MonkeyPodcastLogo_vertical.png">
            <form action="includes/login.inc.php" method="post">
                <input id="mailuid" type="text" name="mailuid" placeholder="Username/E-mail">
                <input id="pwd" type="password" name="pwd" placeholder="Password">
                <a id="signup" href="signup.php">Sign Up</a>
                <button id="login-submit" type="submit" name="login-submit">Login</button>
            </form>
        </div>
    </div>
    <script src="index.js"></script>
    </main>

<?php
    require "footer.php";
?>
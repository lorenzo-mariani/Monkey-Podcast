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
    <div id="main-content">
        <div class="logo">
            <img src="img/logo/MonkeyPodcastLogo_vertical.png" id="logo">
        </div>
         <h1>
             LISTEN TO THE BEST PODCASTS ON THE INTERNET.
        </h1>
        <div id="error-msg" <?php
            if(isset($_GET['error'])){
                echo "style=\"display: grid;\"";
            } else {
                echo "style=\"display: none\"";
            }
            ?>>
            <div id="error-text-container">
                <h4 id="error-text">
                <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "emptyfields"){
                            echo "Please, insert username and password and retry.";
                        } else if($_GET['error'] == "wrong"){
                            echo "Wrong combination of username and password.";
                        }
                    }
                ?>
                </h4>
                <button id="ok-button" type="button" onclick="document.getElementById('error-msg').style.display = 'none'">OK</button>
            </div>
        </div>
        <div id="center-buttons">
            <form action="signup.php" method="post">
                <button id="signup" type="submit" href="signup.php">SIGN UP</button>
            </form>
            <button id="login-button" type="button">LOGIN</button>
        </div>
    </div>

    <div class="bg-modal">
        <div class="modal-content">
            <div class="close">+</div>
            <img id="form-logo" src="img/logo/MonkeyPodcastLogo_vertical.png">
            <form action="includes/login.inc.php" method="post">
                <input id="mailuid" type="text" name="mailuid" placeholder="Username/E-mail">
                <input id="pwd" type="password" name="pwd" placeholder="Password">
                <button id="login-submit" type="submit" name="login-submit">LOGIN</button>
            </form>
        </div>
    </div>
    <script src="index.js"></script>
    </main>
</div>
<?php
    require "footer.php";
?>
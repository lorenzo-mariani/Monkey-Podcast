<style>
<?php include 'css/signupstyle.css'; ?>
</style>

<?php
    session_start();
    if(isset($_SESSION['userId'])){
        header("Location: ./home.php");
    }
?>

<main>
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
                        echo "Please, fill up the form and retry.";
                    } else if($_GET['error'] == "passwordcheck"){
                        echo "Passwords don't match.";
                    }
                }
            ?>
            </h4>
            <button id="ok-button" type="button" onclick="document.getElementById('error-msg').style.display = 'none'">OK</button>
        </div>
    </div>
    <div class="modal-content">
        <img id="form-logo" src="img/logo/MonkeyPodcastLogo_vertical.png">
        <form action="includes/signup.inc.php" method="post">
            <input id="username" type="text" name="uid" placeholder="Username" <?php
            if(isset($_GET['uid']) && isset($_GET['error'])){
                if($_GET['error'] == "emptyfields" || $_GET['error'] == "passwordcheck"){
                    echo "value=\"".$_GET['uid']."\"";
                }
            }
        ?>>
            <input id="email" type="text" name="mail" placeholder="E-mail" <?php
            if(isset($_GET['uid']) && isset($_GET['error'])){
                if($_GET['error'] == "emptyfields" || $_GET['error'] == "passwordcheck"){
                    echo "value=\"".$_GET['mail']."\"";
                }
            }
        ?>>
            <input id="pwd" type="password" name="pwd" placeholder="Password">
            <input id="pwd" type="password" name="pwd-repeat" placeholder="Repeat password">
            <a id="back" href="index.php">BACK</a>
            <button id="signup-submit" type="submit" name="signup-submit">SIGN UP</button>
        </form>
    </div>
</main>

<?php
    require "footer.php"
?>
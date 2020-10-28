<style>
<?php include 'css/signupstyle.css'; ?>
</style>

<main>
        <div class="modal-content">
            <img id="form-logo" src="img/logo/MonkeyPodcastLogo_vertical.png">
            <form action="includes/signup.inc.php" method="post">
                <input id="username" type="text" name="uid" placeholder="Username">
                <input id="email" type="text" name="mail" placeholder="E-mail">
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
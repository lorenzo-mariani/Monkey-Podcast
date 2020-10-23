<?php
if (isset($_POST['signup-submit'])){

    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $mail = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $subs = 0;
    $views = 0;

    if (empty($username) || empty($mail) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid".$username."&mail=".$mail);
        exit();
    } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid".$username);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail".$mail);
        exit();
    } else if ($password !== $passwordRepeat){
        header("Location: ../signup.php?error=passwordcheck&uid".$username."&mail=".$mail);
        exit();
    } else {

        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=".$mail);
                exit();
            }
            else {

                mysqli_stmt_close($stmt);

                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, subs) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssss", $username, $mail, $hashedPwd, $subs);
                    mysqli_stmt_execute($stmt);
                    $basedirname = '../content/users/'.$username;
                    mkdir($basedirname);
                    $podcastsdirname = '../content/users/'.$username.'/'.'podcasts/';
                    mkdir($podcastsdirname);
                    $file = '../templates/profile.php';            
                    $newfile = '../content/users/'.$username.'/'.$username.'.php';
                    if (!copy($file, $newfile)) {
                        echo "failed to copy $file...\n";
                    }
                    $file = '../templates/profile.js';            
                    $newfile = '../content/users/'.$username.'/'.$username.'.js';
                    if (!copy($file, $newfile)) {
                        echo "failed to copy $file...\n";
                    }
                }

                mysqli_stmt_close($stmt);

                $sql = "INSERT INTO channels (channelName, channelViews) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "si", $username, $views);
                    mysqli_stmt_execute($stmt);
                }
                mysqli_stmt_close($stmt);
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../home.php?signup=success");
    exit();

} else {
    header("Location: ../signup.php");
    exit();
}
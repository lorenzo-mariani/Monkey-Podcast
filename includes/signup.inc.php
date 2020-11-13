<?php
if (isset($_POST['signup-submit'])){

    require 'dbh.inc.php';

    $username = str_replace(" ", "_", $_POST['uid']);
    $mail = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $subs = 0;
    $streams = 0;

    if (empty($username) || empty($mail) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$mail);
        exit();
    } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL) && !preg_match("/[a-zA-Z0-9]\s*/", $username)) {
        header("Location: ../signup.php?error=invalidmailuid=".$username);
        exit();
    } else if (!preg_match("/[a-zA-Z0-9]\s*/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=".$mail);
        exit();
    } else if ($password !== $passwordRepeat){
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$mail);
        exit();
    } else {

        $sql_user = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt_user = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt_user, $sql_user)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt_user, "s", $username);
            mysqli_stmt_execute($stmt_user);
            mysqli_stmt_store_result($stmt_user);
            $resultCheck = mysqli_stmt_num_rows($stmt_user);
            if($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=".$mail);
                exit();
            }   else {

                mysqli_stmt_close($stmt_user);

                $sql_email = "SELECT emailUsers FROM users WHERE emailUsers=?";
                $stmt_email = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt_email, $sql_email)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt_email, "s", $mail);
                    mysqli_stmt_execute($stmt_email);
                    mysqli_stmt_store_result($stmt_email);
                    $resultCheck = mysqli_stmt_num_rows($stmt_email);
                    if($resultCheck > 0) {
                        header("Location: ../signup.php?error=mailtaken&uid=".$username);
                        exit();
                    }
                    else {

                        mysqli_stmt_close($stmt_email);

                        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, subs) VALUES (?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../signup.php?error=sqlerror");
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

                        $sql = "INSERT INTO channels (channelName, channelStreams) VALUES (?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../signup.php?error=sqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "si", $username, $streams);
                            mysqli_stmt_execute($stmt);
                        }
                        mysqli_stmt_close($stmt);
                    }
                }
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
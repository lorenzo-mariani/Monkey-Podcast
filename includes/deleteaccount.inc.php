<?php

    require "./dbh.inc.php";

    session_start();

    if(isset($_POST['account-delete-submit']) && $_SESSION['userUid'] == $_POST['account-delete-submit']){
        $query_sub_delete = "UPDATE users
        SET subs = subs - 1
        WHERE
        users.uidUsers IN (SELECT uidUsers FROM ((SELECT channelName FROM subscriptions WHERE subUid = ?) as t1
                        INNER JOIN
                        users
                        ON t1.channelName = users.uidUsers))";
        $query_users = "DELETE FROM users WHERE uidUsers = ?";
        $query_podcasts = "DELETE FROM podcasts WHERE userUID = ?";
        $query_channels = "DELETE FROM channels WHERE channelName = ?";
        $query_subscribed= "DELETE FROM subscriptions WHERE subUid = ?";
        $query_subscriptions = "DELETE FROM subscriptions WHERE channelName = ?";
        $stmt_sub_delete = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_sub_delete, $query_sub_delete)){
            header("Location: ../home.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt_sub_delete, "s", $_SESSION['userUid']);
            mysqli_stmt_execute($stmt_sub_delete);
            mysqli_stmt_close($stmt_sub_delete);
            $stmt_users = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt_users, $query_users)){
                header("Location: ../home.php?error=sqlerrorusers");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt_users, "s", $_SESSION['userUid']);
                mysqli_stmt_execute($stmt_users);
                mysqli_stmt_close($stmt_users);
                $stmt_podcasts = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt_podcasts, $query_podcasts)){
                    header("Location: ../home.php?error=sqlerrorpodcasts");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt_podcasts, "s", $_SESSION['userUid']);
                    mysqli_stmt_execute($stmt_podcasts);
                    mysqli_stmt_close($stmt_podcasts);
                    $stmt_channels = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt_channels, $query_channels)){
                        header("Location: ../home.php?error=sqlerrorchannels");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt_channels, "s", $_SESSION['userUid']);
                        mysqli_stmt_execute($stmt_channels);
                        mysqli_stmt_close($stmt_channels);
                        $stmt_subscriptions = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt_subscriptions, $query_subscriptions)){
                            header("Location: ../home.php?error=sqlerrorsubscriptions");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt_subscriptions, "s", $_SESSION['userUid']);
                            mysqli_stmt_execute($stmt_subscriptions);
                            mysqli_stmt_close($stmt_subscriptions);
                            $stmt_subscribed = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt_subscribed, $query_subscribed)){
                                header("Location: ../home.php?error=sqlerrorsubscribed");
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt_subscribed, "s", $_SESSION['userUid']);
                                mysqli_stmt_execute($stmt_subscribed);
                                mysqli_stmt_close($stmt_subscribed);
                                $podcasts_dir = $_SERVER['DOCUMENT_ROOT'] . "/content/users/".$_SESSION['userUid']."/"."podcasts/";
                                $chimg_dir = $_SERVER['DOCUMENT_ROOT'] . "/content/users/".$_SESSION['userUid']."/"."channel-img/";
                                $basedir = $_SERVER['DOCUMENT_ROOT'] . "/content/users/".$_SESSION['userUid']."/";

                                $podcasts_subdirs = glob($podcasts_dir."*");
                                foreach($podcasts_subdirs as $subdir){
                                    $files = glob($subdir."/"."*");
                                    foreach($files as $file){
                                        if(is_file($file)){
                                            unlink($file);
                                        }
                                    }
                                    rmdir($subdir);
                                }
                                rmdir($podcasts_dir);

                                if(is_dir($chimg_dir)){
                                    $chimg_files = glob($chimg_dir."*");
                                    foreach($chimg_files as $file){
                                        if(is_file($file)){
                                            unlink($file);
                                        }
                                    }
                                    rmdir($chimg_dir);
                                }

                                $basedir_files = glob($basedir."*");
                                foreach($basedir_files as $file){
                                    if(is_file($file)){
                                        unlink($file);
                                    }
                                }
                                rmdir($basedir);
                                mysqli_close($conn);
                            }
                        }
                    }
                }
            }
            header("Location: ./logout.inc.php?delete-submit=true");
        }
    } else {
        header("Location: ../home.php?error=usernotset");
    }

?>
<?php

    require "dbh.inc.php";

    session_start();
    
    $nameChannel = $_POST['subscribe-btn'];
    $uidSub = $_SESSION['userUid'];

    if (empty($nameChannel) || empty($uidSub)) {
        header("Location: ../content/users/".$nameChannel."/".$nameChannel.".php?error=emptyfields&channel".$nameChannel."&sub=".$userUid);
        exit();
    } else {
            $sql_insert = "INSERT INTO subscriptions (channelName, subUid) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql_insert)) {
                header("Location: ../home.php?error=sqlerror_prepare_insert");
                   exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $nameChannel, $uidSub);
                if(!mysqli_stmt_execute($stmt)){
                    header("Location: ../home.php?error=sqlerror_execute_insert");
                }

                $sql_update = "UPDATE users SET subs = subs + 1 WHERE uidUsers = ?";
                if (!mysqli_stmt_prepare($stmt, $sql_update)) {
                    header("Location: ../home.php?error=sqlerror_prepare_update");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $nameChannel);
                    if(!mysqli_stmt_execute($stmt)){
                        header("Location: ../home.php?error=sqlerror_execute_update");
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("Location: ../home.php");
                }
            }
    }
?>
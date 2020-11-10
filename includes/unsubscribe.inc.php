<?php

    require "dbh.inc.php";

    session_start();
    
    $nameChannel = $_POST['unsubscribe-btn'];
    $uidSub = $_SESSION['userUid'];

    if (empty($nameChannel) || empty($uidSub)) {
        header("Location: ../home.php?error=emptyfields&channel".$nameChannel."&sub=".$userUid);
        exit();
    } else {
            $sql_delete = "DELETE FROM subscriptions WHERE subUid=? AND channelName=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql_delete)) {
                header("Location: ../home.php?error=sqlerror");
                   exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $uidSub, $nameChannel);
                if(!mysqli_stmt_execute($stmt)){
                    header("Location: ../home.php?error=sqlerror");
                }
                $sql_update = "UPDATE users SET subs = subs - 1 WHERE uidUsers = ?";
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
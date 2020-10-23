<?php
    require "dbh.inc.php";

    session_start();

    $title = $_GET['title'];
    $channel = $_GET['channel'];

    $stmt = mysqli_stmt_init($conn);
    $sql_update = "UPDATE podcasts SET podcastViews = podcastViews + 1 WHERE podcastTitle = ? AND userUID = ?";
    if (!mysqli_stmt_prepare($stmt, $sql_update)) {
        header("Location: ../home.php?error=sqlerror_prepare_update");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $title, $channel);
        if(!mysqli_stmt_execute($stmt)){
            header("Location: ../home.php?error=sqlerror_execute_update");
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../home.php?subscribe=success&view=home");
    }
?>
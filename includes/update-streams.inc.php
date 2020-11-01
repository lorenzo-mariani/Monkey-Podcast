<?php
    require "dbh.inc.php";

    session_start();

    $title = $_GET['title'];
    $channel = $_GET['channel'];

    if($channel != $_SESSION['userUid']){
            $sql_update_podcast = "UPDATE podcasts SET podcastStreams = podcastStreams + 1 WHERE podcastTitle = ? AND userUID = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql_update_podcast)) {
                header("Location: ../home.php?error=sqlerror_prepare_update");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $title, $channel);
                if(!mysqli_stmt_execute($stmt)){
                    header("Location: ../home.php?error=sqlerror_execute_update");
                }
                $sql_update_channel = "UPDATE channels SET channelStreams = channelStreams + 1 WHERE channelName = ?";
                if (!mysqli_stmt_prepare($stmt, $sql_update_channel)) {
                    header("Location: ../home.php?error=sqlerror_prepare_update");
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $channel);
                    if(!mysqli_stmt_execute($stmt)){
                        header("Location: ../home.php?error=sqlerror_execute_update");
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
        }
    }
?>
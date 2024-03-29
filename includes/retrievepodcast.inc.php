<?php

    require "./dbh.inc.php";

    if(isset($_GET['title']) && isset($_GET['button']) && isset($_GET['channel'])){
        $current_title = $_GET['title'];
        $current_channel = $_GET['channel'];
        $button = $_GET['button'];
        if($button == "next"){
            $query_retrieve = "SELECT podcastTitle, podcastImg, userUid, podcastFile, t1.playlist, uploadTime FROM 
            (SELECT playlist FROM podcasts WHERE podcastTitle = ? AND userUID = ?) AS t1
            INNER JOIN
            podcasts
            ON t1.playlist = podcasts.playlist
            WHERE userUid = ?
            ORDER BY uploadTime ASC";
        } else if($button == "previous"){
            $query_retrieve = "SELECT podcastTitle, podcastImg, userUid, podcastFile, t1.playlist, uploadTime FROM 
            (SELECT playlist FROM podcasts WHERE podcastTitle = ? AND userUID = ?) AS t1
            INNER JOIN
            podcasts
            ON t1.playlist = podcasts.playlist
            WHERE userUid = ?
            ORDER BY uploadTime DESC";
        }
        $stmt_retrieve = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_retrieve, $query_retrieve)){
            header("Location: ../home.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt_retrieve, "sss", $current_title , $current_channel, $current_channel);
            mysqli_stmt_execute($stmt_retrieve);
            mysqli_stmt_store_result($stmt_retrieve);
            $stmt_retrieve->bind_result($title, $img, $user, $file, $playlist, $upload_time);
            $check = 0;
            while($stmt_retrieve->fetch()){
                if($check == 1){
                    echo $title.";".$img.";".$user.";".$file.";".$playlist;
                    break;
                }
                if($title == $current_title){
                    $check = 1;
                }
            }
            mysqli_stmt_close($stmt_retrieve);
            mysqli_close($conn);
        }
    }

?>
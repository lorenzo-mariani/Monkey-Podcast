<?php

    require "./dbh.inc.php";

    session_start();

    if(isset($_GET['title'])){
        $title = $_GET['title'];
        $query = "DELETE FROM podcasts WHERE podcastTitle = ? AND userUID = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $query)){
            header("Location: ../home.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $title ,$_SESSION['userUid']);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "title not set";
    }
    mysqli_close($conn)

?>
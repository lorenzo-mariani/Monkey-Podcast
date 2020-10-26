
<?php

require 'dbh.inc.php';

session_start();

$genre = strtolower($_POST["genre-value"]);
$title = str_replace(' ', '_', strtolower($_POST["podcast-title"]));
$playlist = str_replace(' ', '_', strtolower($_POST["podcast-playlist"]));
$streams = 0;

$target_dir = "../content/users/".$_SESSION['userUid']."/"."podcasts/".$title."/";
$target_file_audio = $target_dir . str_replace(' ','_',basename($_FILES["audio-file"]["name"]));
$target_file_img = $target_dir . str_replace(' ','_',basename($_FILES["img-file"]["name"]));
$checkAudio = 1;
$checkImg = 1;

if(isset($_POST["upload-submit"])) {
    $checkAudio = 1;
    $checkImg = 1;
} else {
    $checkAudio = 0;
    $checkImg = 0;
}

    if (file_exists($target_file_audio)) {
    echo "Sorry, audio file already exists.";
    $checkAudio = 0;
    }

    if (file_exists($target_file_img)) {
        echo "Sorry, image file already exists.";
        $checkImg = 0;
    }

    if ($_FILES["audio-file"]["size"] > 500000000) {
    echo "Sorry, your audio file is too large.";
    $checkAudio = 0;
    }

    if ($_FILES["img-file"]["size"] > 500000000) {
        echo "Sorry, your image file is too large.";
        $checkImg = 0;
    }

    if($genre == "select genre"){
        echo "Sorry, genre not selected.";
        exit();
    }

    if($checkAudio == 1 && $checkImg == 1){
        if(!file_exists($target_dir)){
            mkdir($target_dir);
        }
    } else {
        echo "Sorry, something went wrong.";
        exit();
    }

    if ($checkAudio == 0) {
        echo "Sorry, your audio file was not uploaded.";
        exit();
        } else {
        if (move_uploaded_file($_FILES["audio-file"]["tmp_name"], $target_file_audio)) {
            echo "The file ". htmlspecialchars(basename( $_FILES["audio-file"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your audio file.";
            exit();
        }
    }
    if ($checkImg == 0) {
        echo "Sorry, your img file was not uploaded.";
        exit();
    } else {
        if (move_uploaded_file($_FILES["img-file"]["tmp_name"], $target_file_img)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["img-file"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your image file.";
            exit();
        }
    }

    //Code that operates MySQL querys

    if (empty($title) || empty($genre) || empty($target_dir)) {
        header("Location: ../upload.php?error=emptyfields&title".$title."&genre=".$genre);
        exit();
    } else {
            $sql = "INSERT INTO podcasts (genre, podcastTitle, podcastImg, userUID, podcastStreams, podcastFile, playlist) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ./upload.php?error=sqlerror");
                   exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ssssiss", $genre, $title, $target_file_img, $_SESSION["userUid"], $streams, $target_file_audio, $playlist);
                mysqli_stmt_execute($stmt);
            }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../home.php");
?>
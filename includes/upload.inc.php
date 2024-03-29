
<?php

require 'dbh.inc.php';

session_start();

$genre = strtolower($_POST["genre-value"]);
$title = str_replace(' ', '_', strtolower($_POST["podcast-title"]));
$playlist = str_replace(' ', '_', strtolower($_POST["podcast-playlist"]));
$streams = 0;
date_default_timezone_set("America/New_York");
$upload_time = date("h:i:sa")." ".date("Y/m/d");

$target_dir = "./content/users/".$_SESSION['userUid']."/"."podcasts/".$title."/";
$target_file_audio = $target_dir . str_replace(' ','_',basename($_FILES["audio-file"]["name"]));
$target_file_img = $target_dir . str_replace(' ','_',basename($_FILES["img-file"]["name"]));
$checkAudio = 1;
$checkImg = 1;

$query = "SELECT podcastTitle FROM podcasts WHERE podcastTitle = ? AND userUID = ?";
$stmt = mysqli_stmt_init($conn);

if(!preg_match("/[\/:*?\"<>|]/", $title)){
    if(!mysqli_stmt_prepare($stmt, $query)){
        header("Location: ../upload.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $title ,$_SESSION['userUid']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if($stmt->num_rows == 0){
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
        
            if ($_FILES["audio-file"]["size"] > 5000000000) {
            echo "Sorry, your audio file is too large.";
            $checkAudio = 0;
            }
        
            if ($_FILES["img-file"]["size"] > 5000000000) {
                echo "Sorry, your image file is too large.";
                $checkImg = 0;
            }
            
            mkdir($_SERVER['DOCUMENT_ROOT'] . str_replace("./", "/", $target_dir), 0777, true);
    
            if (empty($title)) {
                header("Location: ../upload.php?error=emptytitle");
                exit();
            } else if(empty($genre)) {
                header("Location: ../upload.php?error=emptygenre");
                exit();
            } else if(empty($playlist)){
                header("Location: ../upload.php?error=emptyplaylist");
                exit();
            } else if($genre == "select genre"){
                header("Location: ../upload.php?error=emptygenre");
                exit();
            } else {
                    if ($checkAudio == 0) {
                        echo "Sorry, your audio file was not uploaded.";
                        exit();
                        } else {
                        if (move_uploaded_file($_FILES["audio-file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . str_replace("./", "/", $target_file_audio))) {
                            echo "The file ". htmlspecialchars(basename( $_FILES["audio-file"]["name"])). " has been uploaded.";
                        } else {
                            header("Location: ../upload.php?error=audioerror&code=".$_FILES["audio-file"]["error"]);
                            exit();
                        }
                    }
                    if ($checkImg == 0) {
                        echo "Sorry, your img file was not uploaded.";
                        exit();
                    } else {
                        if (move_uploaded_file($_FILES["img-file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . str_replace("./", "/", $target_file_img))) {
                            echo "The file ". htmlspecialchars( basename( $_FILES["img-file"]["name"])). " has been uploaded.";
                        } else {
                            header("Location: ../upload.php?error=imgerror&code=".$_FILES["img-file"]["error"]);
                            exit();
                        }
                    }
                    $sql = "INSERT INTO podcasts (genre, podcastTitle, podcastImg, userUID, podcastStreams, podcastFile, playlist, uploadTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../upload.php?error=sqlerror");
                            exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "ssssisss", $genre, $title, $target_file_img, $_SESSION["userUid"], $streams, $target_file_audio, $playlist, $upload_time);
                        mysqli_stmt_execute($stmt);
                    }
                }
                header("Location: ../home.php");
        } else {
            header("Location: ../upload.php?error=podcastexists");
        }
    }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
} else {
    header("Location: ../upload.php?error=invalidtitle");
}
?>

<?php

require 'dbh.inc.php';

session_start();

$genre = strtolower($_POST["genre-value-mod"]);
$new_title = str_replace(' ', '_', strtolower($_POST["podcast-title-mod"]));
$playlist = str_replace(' ', '_', strtolower($_POST["podcast-playlist-mod"]));
$old_title = $_POST["podcast-old-title"];

$old_dir = "../content/users/".$_SESSION['userUid']."/"."podcasts/".$old_title."/";
$target_dir = "../content/users/".$_SESSION['userUid']."/"."podcasts/".$new_title."/";
$target_file_img = $target_dir . str_replace(' ','_',basename($_FILES["img-file-mod"]["name"]));
$checkImg = 1;

$query_check = "SELECT podcastTitle, podcastImg FROM podcasts WHERE podcastTitle = ? AND userUID = ?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $query_check)){
    header("Location: ../upload.php?error=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "ss", $old_title ,$_SESSION['userUid']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $stmt->bind_result($ttl, $old_img);
    while($stmt->fetch()){
        if($stmt->num_rows > 0){
            if ($_FILES["img-file-mod"]["size"] > 5000000000) {
                echo "Sorry, your image file is too large.";
                $checkImg = 0;
            }
        
            if ($checkImg == 0) {
                echo "Sorry, your img file was not uploaded.";
                exit();
            } else {

                $update_title = "UPDATE podcasts SET podcastTitle = ? WHERE podcastTitle = ? AND userUID = ?";
                $update_playlist = "UPDATE podcasts SET playlist = ? WHERE podcastTitle = ? AND userUID = ?";
                $update_img = "UPDATE podcasts SET podcastImg = ? WHERE podcastTitle = ? AND userUID = ?";
                $update_genre = "UPDATE podcasts SET genre = ? WHERE podcastTitle = ? AND userUID = ?";
                $stmt = mysqli_stmt_init($conn);
    
                if(!empty($playlist)) {
                    if (!mysqli_stmt_prepare($stmt, $update_playlist)) {
                        header("Location: ./podcast_settings?error=sqlerror");
                            exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "sss", $playlist, $old_title, $_SESSION['userUid']);
                        mysqli_stmt_execute($stmt);
                    }
                }
                if(!empty($img)){
                    if (!mysqli_stmt_prepare($stmt, $update_img)) {
                        header("Location: ./podcast_settings?error=sqlerror");
                            exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "sss", $target_file_img, $old_title, $_SESSION['userUid']);
                        mysqli_stmt_execute($stmt);
                    }
                }
                if(!($genre == "select genre")){
                    if (!mysqli_stmt_prepare($stmt, $update_genre)) {
                        header("Location: ./podcast_settings?error=sqlerror");
                            exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "sss", $genre, $old_title, $_SESSION['userUid']);
                        mysqli_stmt_execute($stmt);
                    }
                }
    
                if (!empty($new_title)) {
                    if($_FILES["img-file-mod"]["error"] != 4) {
                        if(file_exists($old_img)){
                            unlink($old_img);
                            rename($old_dir, $target_dir);
                            if (move_uploaded_file($_FILES["img-file-mod"]["tmp_name"], $target_file_img)) {
                                echo "The file ". htmlspecialchars( basename( $_FILES["img-file-mod"]["name"])). " has been uploaded.";
                            } else {
                                echo "Sorry, there was an error uploading your image file.";
                                exit();
                            }
                        }
                        if (!mysqli_stmt_prepare($stmt, $update_img)) {
                            header("Location: ./podcast_settings?error=sqlerror");
                                exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "sss", $target_file_img, $old_title, $_SESSION['userUid']);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                    if (!mysqli_stmt_prepare($stmt, $update_title)) {
                        header("Location: ./podcast_settings?error=sqlerror");
                            exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "sss", $new_title, $old_title, $_SESSION['userUid']);
                        mysqli_stmt_execute($stmt);
                    }
                } else {
                    if($_FILES["img-file-mod"]["error"] != 4) {
                        if(file_exists($old_img)){
                            unlink($old_img);
                            $newimage_path = $old_dir . str_replace(' ','_',basename($_FILES["img-file-mod"]["name"]));
                            if (move_uploaded_file($_FILES["img-file-mod"]["tmp_name"], $newimage_path)) {
                                if (!mysqli_stmt_prepare($stmt, $update_img)) {
                                    header("Location: ./podcast_settings?error=sqlerror");
                                        exit();
                                } else {
                                    mysqli_stmt_bind_param($stmt, "sss", $newimage_path, $old_title, $_SESSION['userUid']);
                                    mysqli_stmt_execute($stmt);
                                    echo "The file ". htmlspecialchars( basename( $_FILES["img-file-mod"]["name"])). " has been uploaded.";
                                }
                            } else {
                                echo "Sorry, there was an error uploading your image file.";
                                exit();
                            }
                        }
                    }
                }
                header("Location: ../home.php?view=home");
            }
        } else {
            header("Location: ../podcast_settings?error=notfound".$old_title);
        }
    }
}
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
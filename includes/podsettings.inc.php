
<script type="text/javascript">
    function setCookieSubstring(name, str, value, exdays) {
    var cookie = getCookie(name);
    var c = cookie.split('&');
    for(i = 0; i < c.length; i++){
        if(c[i].substring(0, str.length) == str){
        var string = c[i];
        c[i] = string.replace(c[i].substring(str.length, c[i].length), value);
        }
    }
    var res = (name+"=").concat(c.join('&'));
    document.cookie = res + ";" + exdays + ";path=/";
    }

    function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
    }
</script>

<?php

require 'dbh.inc.php';

session_start();

$genre = strtolower($_POST["genre-value-mod"]);
$new_title = str_replace(' ', '_', strtolower($_POST["podcast-title-mod"]));
$playlist = str_replace(' ', '_', strtolower($_POST["podcast-playlist-mod"]));
$old_title = $_POST["podcast-old-title"];
if(isset($_POST["player-channel"])){
    $player_channel = $_POST["player-channel"];
}

$old_dir = "./content/users/".$_SESSION['userUid']."/"."podcasts/".$old_title."/";
$target_dir = "./content/users/".$_SESSION['userUid']."/"."podcasts/".$new_title."/";
$target_file_img = $target_dir . str_replace(' ','_',basename($_FILES["img-file-mod"]["name"]));
$checkImg = 1;
if(empty($new_title) && empty($playlist) && $genre == "select genre" && $_FILES["img-file-mod"]["error"] == 4){
    header("Location: ../home.php?warning=emptyfields");
} else {
    if(!preg_match("/[\/:*?\"<>|]/", $new_title)){
        $query_check = "SELECT podcastTitle, podcastImg, podcastFile FROM podcasts WHERE podcastTitle = ? AND userUID = ?";
        $stmt_check = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_check, $query_check)){
            header("Location: ../upload.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt_check, "ss", $old_title, $_SESSION['userUid']);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_store_result($stmt_check);
            $stmt_check->bind_result($ttl, $old_img, $old_audiopath);
            if($stmt_check->num_rows > 0){
                while($stmt_check->fetch()){
                    if ($_FILES["img-file-mod"]["size"] > 5000000000) {
                        echo "Sorry, your image file is too large.";
                        exit();
                    } else {
    
                        $update_title = "UPDATE podcasts SET podcastTitle = ? WHERE podcastTitle = ? AND userUID = ?";
                        $update_playlist = "UPDATE podcasts SET playlist = ? WHERE podcastTitle = ? AND userUID = ?";
                        $update_img = "UPDATE podcasts SET podcastImg = ? WHERE podcastTitle = ? AND userUID = ?";
                        $update_genre = "UPDATE podcasts SET genre = ? WHERE podcastTitle = ? AND userUID = ?";
                        $update_audio = "UPDATE podcasts SET podcastFile = ? WHERE podcastTitle = ? AND userUID = ?";
            
                        if(!empty($playlist) && $playlist != str_repeat("_", strlen($playlist))) {
                            $stmt_playlist = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt_playlist, $update_playlist)) {
                                header("Location: ./podcast_settings?error=sqlerror");
                                    exit();
                            } else {
                                mysqli_stmt_bind_param($stmt_playlist, "sss", $playlist, $old_title, $_SESSION['userUid']);
                                mysqli_stmt_execute($stmt_playlist);
                                mysqli_stmt_close($stmt_playlist);
                                if(isset($player_channel)){
                                    if($player_channel == $_SESSION['userUid']){
                                        echo "<script type=\"text/javascript\">
                                        setCookieSubstring(\"memaudio\", \"playlist=\", \"".$playlist."\", 2)
                                        </script>";
                                    }
                                }
                            }
                        }
                        if(!($genre == "select genre")){
                            $stmt_genre = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt_genre, $update_genre)) {
                                header("Location: ./podcast_settings?error=sqlerror");
                                    exit();
                            } else {
                                mysqli_stmt_bind_param($stmt_genre, "sss", $genre, $old_title, $_SESSION['userUid']);
                                mysqli_stmt_execute($stmt_genre);
                                mysqli_stmt_close($stmt_genre);
                            }
                        }
            
                        if (!empty($new_title) && $new_title != str_repeat("_", strlen($new_title))) {
                            if($_FILES["img-file-mod"]["error"] != 4) {
                                if(file_exists(str_replace("./", $_SERVER['DOCUMENT_ROOT'].'/', $old_img))){
                                    unlink(str_replace("./", $_SERVER['DOCUMENT_ROOT'].'/', $old_img));
                                    rename(str_replace("./", $_SERVER['DOCUMENT_ROOT'].'/', $old_dir), str_replace("./", $_SERVER['DOCUMENT_ROOT'].'/', $target_dir));
                                    if (move_uploaded_file($_FILES["img-file-mod"]["tmp_name"], str_replace("./", $_SERVER['DOCUMENT_ROOT'].'/', $target_file_img))) {
                                    } else {
                                        echo "Sorry, there was an error uploading your image file.";
                                        exit();
                                    }
                                }
                                $stmt_img = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt_img, $update_img)) {
                                    header("Location: ./podcast_settings?error=sqlerror");
                                        exit();
                                } else {
                                    mysqli_stmt_bind_param($stmt_img, "sss", $target_file_img, $old_title, $_SESSION['userUid']);
                                    mysqli_stmt_execute($stmt_img);
                                    mysqli_stmt_close($stmt_img);
                                    if(isset($player_channel)){
                                        if($player_channel == $_SESSION['userUid']){
                                            echo "<script type=\"text/javascript\">
                                            setCookieSubstring(\"memaudio\", \"img=\", \"".$target_file_img."\", 2)
                                            </script>";
                                        }
                                    }
                                }
                            } else {
                                rename(str_replace("./", $_SERVER['DOCUMENT_ROOT'].'/', $old_dir), str_replace("./", $_SERVER['DOCUMENT_ROOT'].'/', $target_dir));
                                $stmt_img = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt_img, $update_img)) {
                                    header("Location: ./podcast_settings?error=sqlerror");
                                        exit();
                                } else {
                                    $newpath_img = $target_dir . substr($old_img, strlen($old_dir), strlen($old_img));
                                    mysqli_stmt_bind_param($stmt_img, "sss", $newpath_img, $old_title, $_SESSION['userUid']);
                                    mysqli_stmt_execute($stmt_img);
                                    mysqli_stmt_close($stmt_img);
                                    if(isset($player_channel)){
                                        if($player_channel == $_SESSION['userUid']){
                                            echo "<script type=\"text/javascript\">
                                            setCookieSubstring(\"memaudio\", \"img=\", \"".$newpath_img."\", 2)
                                            </script>";
                                        }
                                    }
                                }
                            }
                            $stmt_audio = mysqli_stmt_init($conn);
                            $new_audiopath = $target_dir . substr($old_audiopath, strlen($old_dir), strlen($old_audiopath));
                            if (!mysqli_stmt_prepare($stmt_audio, $update_audio)) {
                                header("Location: ./podcast_settings?error=sqlerror");
                                    exit();
                            } else {
                                mysqli_stmt_bind_param($stmt_audio, "sss", $new_audiopath, $old_title, $_SESSION['userUid']);
                                mysqli_stmt_execute($stmt_audio);
                                mysqli_stmt_close($stmt_audio);
                                if(isset($player_channel)){
                                    if($player_channel == $_SESSION['userUid']){
                                        echo "<script type=\"text/javascript\">
                                        setCookieSubstring(\"memaudio\", \"audio=\", \"".$new_audiopath."\" , 2)
                                        </script>";
                                    }
                                }
                            }
                            $stmt_title = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt_title, $update_title)) {
                                header("Location: ./podcast_settings?error=sqlerror");
                                    exit();
                            } else {
                                mysqli_stmt_bind_param($stmt_title, "sss", $new_title, $old_title, $_SESSION['userUid']);
                                mysqli_stmt_execute($stmt_title);
                                mysqli_stmt_close($stmt_title);
                                if(isset($player_channel)){
                                    if($player_channel == $_SESSION['userUid']){
                                        echo "<script type=\"text/javascript\">
                                        setCookieSubstring(\"memaudio\", \"name=\", \"".$new_title."\" , 2)
                                        </script>";
                                    }
                                }
                            }
                        } else if($new_title != str_repeat("_", strlen($new_title)) || empty($new_title)) {
                            if($_FILES["img-file-mod"]["error"] != 4) {
                                if(file_exists(str_replace("./", $_SERVER['DOCUMENT_ROOT'].'/', $old_img))){
                                    unlink(str_replace("./", $_SERVER['DOCUMENT_ROOT'].'/', $old_img));
                                    $newimage_path = $old_dir . str_replace(' ','_',basename($_FILES["img-file-mod"]["name"]));
                                    if (move_uploaded_file($_FILES["img-file-mod"]["tmp_name"], str_replace("./", $_SERVER['DOCUMENT_ROOT'].'/', $newimage_path))) {
                                        $stmt_img = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($stmt_img, $update_img)) {
                                            header("Location: ./podcast_settings?error=sqlerror");
                                                exit();
                                        } else {
                                            mysqli_stmt_bind_param($stmt_img, "sss", $newimage_path, $old_title, $_SESSION['userUid']);
                                            mysqli_stmt_execute($stmt_img);
                                            mysqli_stmt_close($stmt_img);
                                            if(isset($player_channel)){
                                                if($player_channel == $_SESSION['userUid']){
                                                    echo "<script type=\"text/javascript\">
                                                    setCookieSubstring(\"memaudio\", \"img=\", \"".$newimage_path."\" , 2);
                                                    </script>";
                                                }
                                            }
                                        }
                                    } else {
                                        echo "Sorry, there was an error uploading your image file.";
                                        exit();
                                    }
                                }
                            }
                        }
                        echo "<div id=\"message-container\">
                            <h4 style=\"font-family: 'caviar_dreamsbold';
                            text-align: center;
                            font-size: 30px;
                            margin-top: 3%;\">PODCAST WAS MODIFIED SUCCESFULLY.</h4>
                            <form action=\"../home.php\" method=\"post\" style=\"text-align: center;\">
                                <button id=\"back-home-button\" type=\"submit\" name=\"back-home-submit\" style=\"height: 80px;
                                width: 200px;\">
                                    GO BACK HOME
                                </button>
                            </form>
                        </div>";
                    }
                }
            } else {
                header("Location: ../home.php?error=notfound".$old_title);
            }
        }
            mysqli_stmt_close($stmt_check);
            mysqli_close($conn);
    } else {
        header("Location: ../home.php?error=invalidtitle");
    }
}
?>
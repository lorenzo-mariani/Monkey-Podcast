
<?php

require 'dbh.inc.php';

session_start();

$target_dir = "./content/users/".$_SESSION['userUid']."/channel-img/";
$target_file_img = $target_dir . str_replace(' ','_',basename($_FILES["img-file"]["name"]));
$checkImg = 1;

if(isset($_POST["channel-img-submit"])) {
    $checkImg = 1;
} else {
    $checkAudio = 0;
    $checkImg = 0;
}

    if (file_exists($target_file_img)) {
        $checkImg = 2;
    }

    if ($_FILES["img-file"]["size"] > 500000000) {
        echo "Sorry, your image file is too large.";
        $checkImg = 0;
    }

    if($checkImg == 1 || $checkImg == 2){
        if(!file_exists($_SERVER['DOCUMENT_ROOT'] . str_replace("./", "/", $target_dir))){
            mkdir($_SERVER['DOCUMENT_ROOT'] . str_replace("./", "/", $target_dir));
        }
    } else {
        echo "Sorry, something went wrong.";
        exit();
    }

    if ($checkImg == 0) {
        echo "Sorry, your img file was not uploaded.";
        exit();
    } else {
        if($checkImg != 2){
            if (move_uploaded_file($_FILES["img-file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . str_replace("./", "/", $target_file_img))) {
                echo "The file ". htmlspecialchars( basename( $_FILES["img-file"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your image file.";
                exit();
            }
        }
    }

    if (empty($target_dir)) {
        header("Location: ./home.php?error=emptyfields");
        exit();
    } else {
            $sql = "UPDATE channels SET channelImg = ? WHERE channelName = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../home.php?error=sqlerror");
                   exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $target_file_img, $_SESSION["userUid"]);
                mysqli_stmt_execute($stmt);
            }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../home.php?upload-img=success&view=home");
?>
<script type="text/javascript">

    function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    };

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
    };

    function getCookieSubstring(name, str) {
        var cookie = getCookie(name);
        var c = cookie.split('&');
        for(i = 0; i < c.length; i++){
            if(c[i].substring(0, str.length) == str){
                var res = c[i].substring(str.length, c[i].length);
                return res;
            }
        }
    };

</script>

<?php

    require "./dbh.inc.php";

    session_start();

    if(isset($_POST['pod-delete-submit'])){
        $title = $_POST['pod-delete-submit'];
        $query_remove = "DELETE FROM podcasts WHERE podcastTitle = ? AND userUID = ?";
        $stmt_remove = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_remove, $query_remove)){
            header("Location: ../home.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt_remove, "ss", $title ,$_SESSION['userUid']);
            mysqli_stmt_execute($stmt_remove);

            $podcast_dir = $_SERVER['DOCUMENT_ROOT'] . "/content/users/".$_SESSION['userUid']."/"."podcasts/".$title."/";

            $files = glob($podcast_dir."*");
            foreach($files as $file){
                if(is_file($file)){
                    unlink($file);
                }
            }

            rmdir($podcast_dir);
        }
        mysqli_stmt_close($stmt_remove);
        mysqli_close($conn);
    
        echo "<script type=\"text/javascript\">
            if(getCookieSubstring('memaudio', 'name=').toLowerCase() == '".strtolower(str_replace("_", " ", $title))."' && getCookieSubstring('memaudio', 'channel=').toLowerCase() == '".strtolower($_SESSION['userUid'])."'){
                setCookie('memaudio', '', -1);
            }
        </script>";
    
        echo "<div id=\"message-container\">
                            <h4 style=\"font-family: 'caviar_dreamsbold';
                            text-align: center;
                            font-size: 30px;
                            margin-top: 3%;\">PODCAST WAS DELETED SUCCESFULLY.</h4>
                            <form action=\"../home.php\" method=\"post\" style=\"text-align: center;\">
                                <button id=\"back-home-button\" type=\"submit\" name=\"back-home-submit\" style=\"height: 80px;
                                width: 200px;\">
                                    GO BACK HOME
                                </button>
                            </form>
                        </div>";
    } else {
        header("Location: ../home.php?error=nopodcastselected");
    }

?>
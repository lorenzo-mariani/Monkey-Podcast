<script type="text/javascript">

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

</script>

<?php

    require "./dbh.inc.php";

    session_start();

    if(isset($_POST['change-playlist-name-submit'])){
        if($_POST['playlist-newname'] != "" && $_POST['playlist-newname'] != null && !empty($_POST['playlist-newname']) && !ctype_space($_POST['playlist-newname'])){
            $new_name = str_replace(" ", "_", $_POST['playlist-newname']);
            $old_name = $_POST['change-playlist-name-submit'];
            $query_update = "UPDATE podcasts SET playlist = ? WHERE userUID = ? AND playlist = ?";
            $stmt_update = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt_update, $query_update)){
                header("Location: ../home.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt_update, "sss", $new_name , $_SESSION['userUid'], $old_name);
                mysqli_stmt_execute($stmt_update);
                echo "<script type=\"text/javascript\">
                if(getCookieSubstring('memaudio', 'name=') != undefined){
                    if(getCookieSubstring('memaudio', 'playlist=').toLowerCase() == '".strtolower( $old_name)."' && getCookieSubstring('memaudio', 'channel=').toLowerCase() == '".strtolower($_SESSION['userUid'])."'){
                        setCookieSubstring('memaudio', 'playlist=', '".$new_name."', 2);
                    }
                }
                </script>";
            
                echo "<div id=\"message-container\">
                                    <h4 style=\"font-family: 'caviar_dreamsbold';
                                    text-align: center;
                                    font-size: 30px;
                                    margin-top: 3%;\">PLAYLIST WAS UPDATED SUCCESFULLY.</h4>
                                    <form action=\"../home.php\" method=\"post\" style=\"text-align: center;\">
                                        <button id=\"back-home-button\" type=\"submit\" name=\"back-home-submit\" style=\"height: 80px;
                                        width: 200px;\">
                                            GO BACK HOME
                                        </button>
                                    </form>
                                </div>";
                mysqli_stmt_close($stmt_update);
                mysqli_close($conn);
            }
        
        } else {
            header("Location: ../home.php?&error=newplaylistempty");
        }
    } else {
        header("Location: ../home.php?&error=playlistempty");
    }

?>
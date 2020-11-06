<?php
    if(isset($_POST['logout-submit'])){
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../index.php");
    } else if(isset($_GET['delete-submit'])){
        if($_GET['delete-submit'] == "true"){
            if (isset($_SERVER['HTTP_COOKIE'])) {
                $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                foreach($cookies as $cookie) {
                    $parts = explode('=', $cookie);
                    $name = trim($parts[0]);
                    setcookie($name, '', time()-1000);
                    setcookie($name, '', time()-1000, '/');
                }
            }
            session_start();
            session_unset();
            session_destroy();
            header("Location: ../index.php");
        }
    }
?>

</body>
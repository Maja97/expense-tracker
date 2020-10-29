<?php
    session_start();
    session_destroy();
    if(isset($_COOKIE['username']) and isset($_COOKIE['pwd'])) {
        $username = $_COOKIE['username'];
        $pwd  = $_COOKIE['pwd'];
        setcookie('username', $username, time() - 1, '/');
        setcookie('pwd', $pwd, time() - 1, '/');
        unset($username);
        unset($pwd);
    }
    header("Location: ../index.php");
   
?>

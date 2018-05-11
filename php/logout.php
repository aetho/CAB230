<?php
    session_start();
    if($_SESSION['loggedIn']){
        $_SESSION = array();
        session_destroy();
    }

    header("Location: http://{$_SERVER['HTTP_HOST']}/index.php")
?>
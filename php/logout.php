<?php
    // Start session if not started already
    session_start();
    // If logged in then empty session and destroy session
    if($_SESSION['loggedIn']){
        $_SESSION = array();
        session_destroy();
    }

    // Redirect to index page
    header("Location: http://{$_SERVER['HTTP_HOST']}/index.php")
?>
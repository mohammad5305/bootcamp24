<?php 
    session_start();
    if (isset($_COOKIE['remember_me'])) {
        unset($_COOKIE['remember_me']);
        setcookie('remember_me', '', -1, '/'); 
    }

    session_destroy();
    header('location: login.php');
?>


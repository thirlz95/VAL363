<?php

    ini_set("session.save_path", "/home/unn_w14040301/sessionData");
    
    session_start(); 
    
    unset($_SESSION['user']);
    unset($_SESSION['logged-in']);
    session_destroy();

    header("Location: index.php");
    exit;
?>
<?php
    session_start();
    session_unset();
    session_destroy();
    
    header("Location: LoginPage_Admin.php");
?>
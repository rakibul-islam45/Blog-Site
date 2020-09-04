<?php
    session_start();


        unset($_SESSION['id']);
        unset($_SESSION['password']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);



        header('location: adminLogin.php');

?>

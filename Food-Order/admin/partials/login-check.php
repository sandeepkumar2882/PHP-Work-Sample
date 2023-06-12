<?php

    //Authorizon or Access Control
    //Check user logged in or not

    if(!isset($_SESSION['user'])){
        
        //User is not logged in
        //Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error'>Please login to access Admin Panel.</div>";
        header('Location:'.SITEURL.'/admin/login.php');
    }
?>
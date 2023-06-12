<?php

    //Include constants file
    include('../config/constants.php');

    //Destroy the session
    session_destroy(); //Unset $_SESSION['user']

    //Redirect to login page
    header('Location:' . SITEURL . '/admin/login.php');

?>
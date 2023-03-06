<?php 
    //Include constants.php for SITEURL
    include('../config/constants.php');

    //1. Destory the Session
    session_destroy(); //Unsets $_SESSION['user'] present in login file

    //2. Redirect to Login Page
    header('location:'.SITEURL.'admin/login.php');

?>